@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Заказ ' . $order->id)
@section('header', 'Заказ ' . $order->id )
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
@endsection
@section('breadcrumb', $order->id)

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <h3>Автомобиль</h3>
            <table class="table mb-5">
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
                <th scope="col">VIN-код</th>
                <td>{{ $order->car->vin }}</td>
                </tr>
                <tr>
                    <th scope="col">Клиент</th>
                    <td>{{ $order->car->user->name . ' ' . $order->car->user->last_name }}</td>
                </tr>
                <tr>
                    <th scope="col">Телефон клиента</th>
                    <td>{{ $order->car->user->phone }}</td>
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
                    <th scope="col">Заказ выполнен</th>
                    <td></td>
                </tr>
                <tr>
                    <th scope="col">Заказ оплачен</th>
                    <td></td>
                </tr>
                <tr>
                    <th scope="col">Отзыв клиента</th>
                    <td></td>
                </tr>
                </tbody>
            </table>

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
            <div class="col-12">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary me-2">Назад</a>
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning me-2"><i
                        class="fa-solid fa-pen"></i></a>
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" style="display:inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
