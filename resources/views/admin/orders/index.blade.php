@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Перечень заказов')
@section('header', 'Заказы')
@section('breadcrumb', 'Заказы')

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4 mb-5">
            @include('admin.includes.header')
            <form class="row mb-3" action="" method="get">
                <h5>Показать заказы (с - по)</h5>
                <div class="col-1 col-md-3 col-sm-4 form-group">
                    <input type="date" class="form-control" name="date_from" value="{{ $dates['date_from'] }}">
                </div>
                <div class="col-1 col-md-3 col-sm-4 form-group">
                    <input type="date" class="form-control" name="date_to" value="{{ $dates['date_to'] }}">
                </div>
                <div class="col-1 col-md-3 col-sm-4 form-group">
                    <button type="submit" class="btn btn-secondary">Показать</button>
                </div>
            </form>
            @error('date_from')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary mb-3">Добавить заказ</a>
            <table class="table" id="orders">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">№ заказа</th>
                    <th scope="col" style="width: 7em">Дата и время заказа</th>
                    <th scope="col">Автомобиль</th>
                    <th scope="col">Работы</th>
                    <th scope="col" style="width: 3em">Время, часов</th>
                    <th scope="col" style="width: 4em">Сумма, грн.</th>
                    <th scope="col" style="width: 4em">Статус</th>
                    <th scope="col" style="width: 4em">Действия</th>
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
                            <i class="fa-solid fa-calendar-check me-2 {{ isset($order->schedule->start_time) ? ($order->is_schedule_errors ? 'text-danger' : 'text-success') : '' }}" title="Заказ{{ isset($order->schedule->start_time) ? '' : ' не' }} добавлен в расписание{{ $order->is_schedule_errors ? '. Имеется ошибка!' : '' }}"></i>
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
        </div>
        <script>
            $(document).ready(function () {
                $('#orders').DataTable({
                    order: [[0, 'desc']],
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Заказов не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Заказов не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ заказов)',
                        search: 'Поиск заказа ',
                        paginate: {
                            "next": "Вперед",
                            "previous": "Назад"
                        },
                    },
                    stateSave: true,
                });
            });
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
