@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Перечень заказов')
@section('header', 'Заказы')
@section('breadcrumb', 'Заказы')

@section('content')
    <main>
        <div class="container-fluid px-4 mb-5">
            @include('admin.includes.header')
            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Добавить заказ</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 5em">№</th>
                    <th scope="col" style="width: 9em">Дата и время</th>
                    <th scope="col">Автомобиль</th>
                    <th scope="col">Работы</th>
                    <th scope="col" style="width: 4em">Время, часов</th>
                    <th scope="col" style="width: 8em">Сумма, грн.</th>
                    <th scope="col" style="width: 6em">Статус</th>
                    <th scope="col" style="width: 6em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->car->model->brand->title . ' ' . $order->car->model->title . ' ' . $order->car->year }}</td>
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
                            <i class="fa-solid fa-calendar-check me-2 {{ isset($order->schedule->start_time) ? 'text-success' : '' }}" title="Заказ{{ isset($order->schedule->start_time) ? '' : ' не' }} добавлен в расписание"></i>
                            <i class="fa-solid fa-circle-check me-2 {{ $order->is_done ? 'text-success' : '' }}" title="Заказ{{ $order->is_done ? '' : ' не' }} выполен"></i>
                            <i class="fa-solid fa-sack-dollar {{ $order->is_paid ? 'text-success' : '' }}" title="Заказ{{ $order->is_paid ? '' : ' не' }} оплачен"></i>

                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" style="display:inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-light" style="display: contents">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
