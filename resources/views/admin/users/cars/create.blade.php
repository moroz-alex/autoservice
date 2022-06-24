@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Добавление автомобиля пользователя')
@section('header', 'Добавить авто пользователя ' . $user->last_name . ' ' . $user->name)
@section('breadcrumb', 'Добавление авто пользователя')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a
            href="{{ route('admin.users.index') }}">{{ 'Пользователи' }}</a>
    </li>
    <li class="breadcrumb-item"><a
            href="{{ route('admin.users.show', $user->id) }}">{{ 'Пользователь ' . $user->last_name . ' ' . $user->name }}</a>
    </li>
@endsection

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('users.cars.store', $user->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="models" class="form-label">Выберите модель <span class="text-danger">*</span></label>
                            <table class="table" id="models">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 4em">ID</th>
                                    <th scope="col">Марка</th>
                                    <th scope="col">Модель</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($models as $model)
                                    <tr>
                                        <td>{{ $model->id }}</td>
                                        <td>{{ $model->brand->title }}</td>
                                        <td>{{ $model->title }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <input type="hidden" name="model_id" value="">
                            @error('model_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Год выпуска</label>
                            <input type="text" class="form-control" name="year" id="year"
                                   placeholder="Введите год выпуска автомобиля"
                                   value="{{ old('year') }}">
                            @error('year')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <script>
                                $(document).ready(function() {
                                    $("#year").mask("9999");
                                });
                            </script>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Гос. номер</label>
                            <input type="text" class="form-control" name="number" id="number"
                                   placeholder="Введите номер автомобиля"
                                   value="{{ old('number') }}">
                            @error('number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="vin" class="form-label">VIN-код</label>
                            <input type="text" class="form-control" name="vin" id="vin"
                                   placeholder="Введите VIN-код автомобиля"
                                   value="{{ old('vin') }}">
                            @error('vin')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <script>
                                $(document).ready(function() {
                                    $("#vin").mask("*****************");
                                });
                            </script>
                        </div>

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <script>
            $(document).ready(function () {
                var events = $('#events');
                var table = $('#models').DataTable({
                    select: {
                        style: 'single'
                    },

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
                });

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
    @include('admin.includes.footer')
@endsection
