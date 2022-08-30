@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Добавление нового заказа')
@section('header', 'Добавить заказ')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('user.orders.index') }}">Заказы</a></li>
@endsection
@section('breadcrumb', 'Добавление заказа')

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('user.includes.header')

            <div class="row">
                <div class="col-12 mb-5">
                    <form action="{{ route('user.orders.store' ) }}" method="post" name="orders">
                        @csrf
                        <h3>Автомобиль</h3>
                        <a id="add_car" href="{{ route('user.cars.create', ['quickOrder' => 1]) }}" class="btn btn-secondary mb-3 float-end" title="Добавить новый автомобиль выбранному клиенту">Добавить автомобиль</a>
                        <div class="mb-3">
                            <label for="cars" class="form-label">Выберите автомобиль <span class="text-danger">*</span></label>
                            <table class="table" id="cars">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 3em">ID</th>
                                    <th scope="col">Модель</th>
                                    <th scope="col">Номер</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cars as $car)
                                    <tr class="{{ old('car_id') == $car->id || $car->id == $carId ? ' selected' : '' }}">
                                        <td>{{ $car->id }}</td>
                                        <td>{{ $car->model->brand->title . ' ' . $car->model->title . ' ' . $car->year }}</td>
                                        <td>{{ $car->number }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <input type="hidden" name="car_id" value="">
                            @error('car_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <h3>Работа</h3>
                        <div class="mb-3">
                            <label for="tasks" class="form-label">Выберите работу <span
                                    class="text-danger">*</span></label>
                            <table class="table" id="tasks">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 3em">ID</th>
                                    <th scope="col" class="d-sm-none d-md-table-cell">Категория</th>
                                    <th scope="col">Работа</th>
                                    <th scope="col" style="width: 3em">Время, мин.</th>
                                    <th scope="col" style="width: 3em" hidden>Цена нч, грн.</th>
                                    <th scope="col" style="width: 3em">Цена услуги, грн.</th>
                                    <th scope="col" style="width: 3em">Кол-во</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr class="{{ is_array(old('task_ids')) && in_array($task->id, old('task_ids')) ? ' selected' : '' }}">
                                        <td>{{ $task->id }}</td>
                                        <td class="d-sm-none d-md-table-cell">{{ $task->category->title }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td><input type="text" name="task_drs" value="{{ $task->duration }}"
                                                   style="width: 5em" readonly></td>
                                        <td hidden><input type="text" name="task_prs" value="{{ $task->price }}"
                                                   style="width: 5em" readonly></td>
                                        <td><input type="text" name="task_val"
                                                   value="{{ $task->price * ($task->duration / 60) }}"
                                                   style="width: 5em" readonly></td>
                                        <td><input type="text" name="task_qts" value="1" style="width: 5em" readonly>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div id="taskDuration">
                            </div>
                            <div id="taskPrice">
                            </div>
                            <div id="taskId">
                            </div>
                            <div id="taskQty">
                            </div>
                            @error('task_ids')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('task_qts')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('user.orders.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <script>
            var taskIds;
            var taskQts;
            var taskPrs;
            var taskDrs;
            var table_tasks;
            $(document).ready(function () {
                var events = $('#events');
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
                });

                table_cars.rows('.selected').select();
                getTableCarsData();

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

                var table_tasks = $('#tasks').DataTable({
                    select: {
                        style: 'single',
                    },

                    order: [[1, 'asc']],

                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Работ не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Работ не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ работ)',
                        search: 'Поиск работы или категории ',
                        paginate: {
                            "next": "Вперед",
                            "previous": "Назад"
                        },
                        select: {
                            rows: ""
                        },
                    },
                    columns: [
                        {data: 'id'},
                        {data: 'category'},
                        {data: 'title'},
                        {data: 'duration'},
                        {data: 'price'},
                        {data: 'val'},
                        {data: 'quantity'},
                    ],
                    stateSave: true,
                });

                getTableTasksData();

                table_tasks.rows('.selected').select();

                table_tasks
                    .on('select', function (e, dt, type, indexes) {
                        getTableTasksData();
                    })
                    .on('deselect', function (e, dt, type, indexes) {
                        getTableTasksData();
                    })

                function getTableTasksData() {
                    taskIds = table_tasks.rows('.selected').data().pluck('id').toArray();
                    taskQts = table_tasks.rows('.selected').data().pluck('quantity').toArray();
                    taskPrs = table_tasks.rows('.selected').data().pluck('price').toArray();
                    taskDrs = table_tasks.rows('.selected').data().pluck('duration').toArray();
                };
            });


            $("form").submit(function () {
                var res = "";
                taskIds.forEach(function (item, i, taskIds) {
                    res = res + "<input type='hidden' name='task_ids[" + i + "]' value='" + item + "'>";
                });
                document.getElementById('taskId').innerHTML = res;

                var res = "";
                taskDrs.forEach(function (item, i, taskDrs) {
                    item = item.replace('task_drs', 'task_drs[' + i + ']');
                    item = item.replace('text', 'hidden');
                    res = res + item;
                });
                document.getElementById('taskDuration').innerHTML = res;

                var res = "";
                taskPrs.forEach(function (item, i, taskPrs) {
                    item = item.replace('task_prs', 'task_prs[' + i + ']');
                    item = item.replace('text', 'hidden');
                    res = res + item;
                });
                document.getElementById('taskPrice').innerHTML = res;

                var res = "";
                taskQts.forEach(function (item, i, taskQts) {
                    item = item.replace('task_qts', 'task_qts[' + i + ']');
                    item = item.replace('text', 'hidden');
                    res = res + item;
                });
                document.getElementById('taskQty').innerHTML = res;
            });
        </script>
    </main>
    @include('user.includes.footer')
@endsection
