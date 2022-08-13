@extends('layouts.main')

@section('title', 'МойАвтосервис : Заказ ' . $order->id)
@section('header', 'Заказ ' . $order->id )
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('user.orders.index', $user->id) }}">Заказы</a></li>
@endsection
@section('breadcrumb', 'Заказ')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('includes.header')
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <h3>Автомобиль</h3>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="col" style="width: 19em">Марка и модель</th>
                            <td>{{ $order->car->model->brand->title . ' ' . $order->car->model->title . ' ' . $order->car->year }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Гос. номер</th>
                            <td>{{ $order->car->number }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Менеджер</th>
                            <td>{{ $order->user->name  . ' ' . $order->user->last_name}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Мастер</th>
                            <td>{{ isset($order->schedule) ? $order->schedule->master->first_name . ' ' . $order->schedule->master->last_name : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Дата и время начала работ</th>
                            <td>{{ isset($order->schedule) ? date('d.m.Y H:i', strtotime($order->schedule->start_time)) : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Длительность работ, часов</th>
                            <td>{{ $order->duration / 60}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Сумма заказа, грн.</th>
                            <td>{{ $order->price }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Заказ оплачен</th>
                            <td>{!! $order->is_paid ? "<i class=\"fa-solid fa-square-check text-success\"></i>" : "<i class=\"fa-solid fa-square-xmark text-black-50\"></i>" !!}</td>
                        </tr>
                        <tr>
                            <th scope="col">Отзыв клиента</th>
                            <td><a href="#" class="btn btn-secondary btn-sm">Добавить отзыв</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 mb-5">
                    <h3>Статусы заказа</h3>
                    <table class="table" id="states">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col" style="width: 11em">Дата и время</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->states as $key => $state)
                            <tr {!! $key == last($order->states) ? "" : "class='text-black-50'" !!}>
                                <td>{{ $state->title }}</td>
                                <td>{{ $state->pivot->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <h3>Перечень работ</h3>
            <table class="table mb-5">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">Арт.</th>
                    <th scope="col" style="width: 15em">Категория работ</th>
                    <th scope="col">Наименование работы</th>
                    <th scope="col">Время, ч.</th>
                    <th scope="col">Цена нч, грн.</th>
                    <th scope="col">Кол-во</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->tasks->sortBy('category.title') as $task)
                    <tr>

                        <td>{{ $task->id }}</td>
                        <td>{{ $task->category->title }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->pivot->duration / 60 }}</td>
                        <td>{{ $task->pivot->price }}</td>
                        <td>{{ $task->pivot->quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-12 mb-5">
                <a href="{{ route('user.orders.index', $user->id) }}" class="btn btn-secondary me-2">Назад</a>
                @if(!isset($order->schedule->start_time))
                    <a href="{{ route('user.orders.edit', ['user' => $user->id, 'order' => $order->id]) }}"
                       class="btn btn-warning me-2"><i
                            class="fa-solid fa-pen"></i></a>
                @endif
                {{--                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" style="display:inline">--}}
                {{--                    @csrf--}}
                {{--                    @method('delete')--}}
                {{--                    <button class="btn btn-danger">--}}
                {{--                        <i class="fa-solid fa-trash"></i>--}}
                {{--                    </button>--}}
                {{--                </form>--}}
            </div>
        </div>
    </main>
    @include('includes.footer')
@endsection
