@extends('layouts.main')

@section('title', 'МойАвтосервис : Заказы клиента ' . $user->name . ' ' . $user->last_name)
@section('header', 'Заказы' )
@section('breadcrumb', 'Заказы клиента')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('includes.header')
            <table class="table" id="orders">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">№ заказа</th>
                    <th scope="col" style="width: 7em">Дата и время работ</th>
                    <th scope="col">Автомобиль</th>
                    <th scope="col">Работы</th>
                    <th scope="col" style="width: 3em">Время, часов</th>
                    <th scope="col" style="width: 4em">Сумма, грн.</th>
                    <th scope="col" style="width: 6em">Статус</th>
                    <th scope="col" style="width: 4em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->schedule->start_time ?? '' }}</td>
                        <td>{{ $order->car->model->brand->title . ' ' . $order->car->model->title . ' ' . $order->car->year}}
                            <br>VIN: {{ $order->car->vin ?? '-' }}<br>г/н: {{ $order->car->number ?? '-' }}</td>
                        <td>
                            @foreach($order->tasks->sortBy('category.title') as $task)
                                <span class="text-black-50">{{ $task->category->title }}: </span>{{ $task->title }} <br>
                            @endforeach
                        </td>
                        <td>
                            {{ $order->duration / 60}}
                        </td>
                        <td>
                            {{ $order->price }}
                        </td>
                        <td style="color: #E0E0E0">
                            <i class="fa-solid fa-calendar-check me-2 {{ isset($order->schedule->start_time) ? ($order->is_schedule_errors ? 'text-danger' : 'text-success') : '' }}"
                               title="Заказ{{ isset($order->schedule->start_time) ? '' : ' не' }} добавлен в расписание{{ $order->is_schedule_errors ? '. Имеется ошибка!' : '' }}"></i>
                            <i class="fa-solid fa-circle-check me-2 {{ $order->is_done ? 'text-success' : '' }}"
                               title="Заказ{{ $order->is_done ? '' : ' не' }} выполен"></i>
                            <i class="fa-solid fa-sack-dollar {{ $order->is_paid ? 'text-success' : '' }}"
                               title="Заказ{{ $order->is_paid ? '' : ' не' }} оплачен"></i>
                        </td>
                        <td>
                            <a href="{{ route('user.orders.show', ['user' => $user->id, 'order' => $order->id]) }}"
                               class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            @if(!isset($order->schedule->start_time))
                                <a href="{{ route('user.orders.edit', ['user' => $user->id, 'order' => $order->id]) }}"
                                   class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            @endif
                            {{--                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" style="display:inline">--}}
                            {{--                                @csrf--}}
                            {{--                                @method('delete')--}}
                            {{--                                <button class="btn btn-light" style="display: contents">--}}
                            {{--                                    <i class="fa-solid fa-trash"></i>--}}
                            {{--                                </button>--}}
                            {{--                            </form>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </main>
    @include('includes.footer')
@endsection
