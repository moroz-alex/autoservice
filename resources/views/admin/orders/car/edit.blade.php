@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Редактирование авто')
@section('header', 'Редактировать авто заказа ' . $order->id)
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.show', $order->id) }}">Заказ {{ $order->id }}</a></li>
@endsection
@section('breadcrumb', 'Редактирование авто')

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/keytable/2.7.0/js/dataTables.keyTable.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12 mb-5">
                    <form action="{{ route('admin.orders.car.update', $order->id) }}" method="post" name="orders">
                        @csrf
                        @method('patch')
                        <h3>Автомобиль</h3>
                        <div class="mb-3">
                            <label for="cars" class="form-label">Выберите автомобиль <span class="text-danger">*</span></label>
                            <table class="table" id="cars">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 3em">ID</th>
                                    <th scope="col">Модель</th>
                                    <th scope="col" style="width: 8em">Номер</th>
                                    <th scope="col" style="width: 25em">Владелец</th>
                                    <th scope="col" style="width: 9em">Телефон владельца</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cars as $car)
                                    <tr
                                        @if(!is_null(old('car_id')) && old('car_id') == $car->id)
                                        class="selected"
                                        @elseif(is_null(old('car_id')) && $car->id == $order->car->id)
                                        class="selected"
                                        @endif>
                                        <td>{{ $car->id }}</td>
                                        <td>{{ $car->model->brand->title . ' ' . $car->model->title . ' ' . $car->year }}</td>
                                        <td>{{ $car->number }}</td>
                                        <td>{{ $car->user->name . ' ' . $car->user->last_name }}</td>
                                        <td>{{ $car->user->phone }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <input type="hidden" name="car_id" value="{{ $order->car->id }}">
                            @error('car_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                var table_cars = $('#cars').DataTable({
                    select: {
                        style: 'single',
                        toggleable: false,
                    },

                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Автомобилей не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Автомобилей не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ авто)',
                        search: 'Поиск авто ',
                        paginate: {
                            "next": "Вперед",
                            "previous": "Назад"
                        },
                        select: {
                            rows: ""
                        },
                    },
                    keys: true,
                });

                table_cars.rows('.selected').select();
                getTableCarsData();

                var selectedCell = table_cars.row( '.selected' ).index();
                table_cars.cell( selectedCell, 0 ).focus();

                table_cars
                    .on('select', function (e, dt, type, indexes) {
                        getTableCarsData();
                    })
                    .on('deselect', function (e, dt, type, indexes) {
                        $("input[name='car_id']").val('');
                    });

                function getTableCarsData() {
                    var rowData = table_cars.rows('.selected').data().toArray();
                    if (rowData.length > 0) {
                        $("input[name='car_id']").val(rowData[0][0]);
                    }
                }
            });
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
