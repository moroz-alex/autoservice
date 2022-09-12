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
            <form class="row mb-5" action="" method="get">
                <h5>Показать заказы (с - по)</h5>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 form-group">
                    <input type="date" class="form-control" name="date_from" value="{{ $dates['date_from'] }}">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 form-group">
                    <input type="date" class="form-control" name="date_to" value="{{ $dates['date_to'] }}">
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 form-group">
                    <button type="submit" class="btn btn-secondary">Показать</button>
                </div>
                @error('date_from')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('date_to')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </form>

            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary mb-3 me-3">Добавить заказ</a>
            <table class="table table-hover" id="orders">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">№ заказа</th>
                    <th scope="col" style="width: 7em">Дата и время заказа</th>
                    <th scope="col">Автомобиль</th>
                    <th scope="col">Работы</th>
                    <th scope="col" style="width: 3em">Время, часов</th>
                    <th scope="col" style="width: 4em">Сумма, грн.</th>
                    <th scope="col" style="width: 5em">Статус</th>
                    <th scope="col" style="width: 5em">Оплата</th>
                    <th scope="col" style="width: 3em">Дейст-вия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr id="{{ $order->id }}">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ isset($order->car) && isset($order->car->model) && isset($order->car->model->brand) ? $order->car->model->brand->title . ' ' . $order->car->model->title . ' ' . $order->car->year . ' ' . $order->car->number : 'Ошибка!' }}</td>
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
                        <td>
                            <span class="badge state state-{{ $order->states->first()->id ?? '0' }}">
                                {{ $order->states->first()->title ?? '' }}
                            </span>
                        </td>
                        <td>
                            {!! $order->is_paid ? "<span class='badge bg-success state'>Оплачен</span>" : "<span class='badge bg-secondary state'>Нет оплаты</span>" !!}
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="me-2"><i
                                    class="fa-solid fa-eye link-dark"></i></a>
                            @if(!isset($order->schedule->start_time) || $order->schedule->has_error)
                                <a href="{{ route('admin.schedules.edit', $order->id) }}" class="me-2"><i
                                        class="fa-solid fa-calendar-check text-danger"
                                        title="{{ !isset($order->schedule->start_time) ? 'Заказ не добавлен в расписание!' : 'Ошибка в расписании!' }}"></i></a>

                            @endif
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
            var url = "{{ route('admin.orders.show', 'orderId') }}";
            $('#orders tbody tr').click(function () {
                id = $(this).attr('id').match(/\d+/)[0];
                window.location.href = url.replace('orderId', id);
            });
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
