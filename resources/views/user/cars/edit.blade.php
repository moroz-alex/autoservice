@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Редактирование автомобиля ' . $car->model->title)
@section('header', 'Редактирование автомобиля пользователя')
@section('breadcrumb', 'Редактирование авто ' . $car->model->brand->title . ' ' . $car->model->title)
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a
            href="{{ route('user.cars.index') }}">{{ 'Автомобили клиента' }}</a>
    </li>
@endsection

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/keytable/2.7.0/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('user.includes.header')

            <div class="row">
                <div class="col-12 mb-5">
                    @if($hasOrders)
                        <div class="alert alert-warning" role="alert">
                            По данному автомобилю найдены заказы, поэтому не все поля доступны для редактирования!
                        </div>
                    @endif
                    <form action="{{ route('user.cars.update', $car->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="models" class="form-label">Выберите модель <span
                                    class="text-danger">*</span></label>
                            <table class="table {{ $hasOrders ? 'text-muted' : '' }}" id="models">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 4em">ID</th>
                                    <th scope="col">Марка</th>
                                    <th scope="col">Модель</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($models as $model)
                                    <tr class="{{ $car->model_id == $model->id ? ' selected' : ''}}">
                                        <td>{{ $model->id }}</td>
                                        <td>{{ $model->brand->title }}</td>
                                        <td>{{ $model->title }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <input type="hidden" name="model_id" value="{{ $car->model_id }}">
                            @error('model_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Год выпуска</label>
                            <input type="text" class="form-control" name="year" id="year"
                                   placeholder="Введите год выпуска автомобиля"
                                   value="{{ $car->year }}" {{ $hasOrders ? 'readonly' : '' }}>
                            @error('year')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <script>
                                $(document).ready(function () {
                                    $("#year").mask("9999");
                                });
                            </script>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Гос. номер</label>
                            <input type="text" class="form-control" name="number" id="number"
                                   placeholder="Введите номер автомобиля"
                                   value="{{ $car->number }}">
                            @error('number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="vin" class="form-label">VIN-код</label>
                            <input type="text" class="form-control" name="vin" id="vin"
                                   placeholder="Введите VIN-код автомобиля"
                                   value="{{ $car->vin }}" {{ $hasOrders && $car->vin ? 'readonly' : '' }}>
                            @error('vin')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <script>
                                $(document).ready(function () {
                                    $("#vin").mask("*****************");
                                });
                            </script>
                        </div>

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{ route('user.cars.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>

                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {

                var events = $('#events');
                var table = $('#models').DataTable({
                    select: {
                        style: 'single',
                        @if($hasOrders)
                        selector: 'td:not(:nth-child(1),:nth-child(2),:nth-child(3))',
                        @endif
                    },
                    stateSave: true,
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Моделей не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Моделей не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ моделей)',
                        search: 'Поиск модели ',
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

                table.row('.selected').select();
                var selectedCell = table.row('.selected').data();
                table.cell(selectedCell[0] - 2, 0).focus();

                table
                    .on('select', function (e, dt, type, indexes) {
                        var rowData = table.rows(indexes).data().toArray();
                        $("input[name='model_id']").val(rowData[0][0]);
                    })
                    .on('deselect', function (e, dt, type, indexes) {
                        $("input[name='model_id']").val('');
                    });
            });
        </script>
    </main>
    @include('user.includes.footer')
@endsection
