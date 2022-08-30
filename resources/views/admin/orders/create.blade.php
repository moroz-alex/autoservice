@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Добавление нового заказа')
@section('header', 'Добавить заказ')
@section('breadcrumb', 'Добавление заказа')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
@endsection

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
                    <form action="{{ route('admin.orders.store') }}" method="post" name="orders">
                        @csrf
                        <h3>Автомобиль</h3>
                        <a id="add_car" href="#" class="btn btn-secondary mb-3 float-end" style="display: none"
                           title="Добавить новый автомобиль выбранному клиенту">Добавить авто клиенту</a>
                        <a href="{{ route('admin.users.create', ['quickOrder' => true]) }}"
                           class="btn btn-secondary mb-3 me-3 float-end">Добавить клиента</a>
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
                                    <th hidden></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cars as $car)
                                    <tr class="{{ old('car_id') == $car->id || $car->id == $carId ? ' selected' : '' }}">
                                        <td>{{ $car->id }}</td>
                                        <td>{{ $car->model->brand->title . ' ' . $car->model->title . ' ' . $car->year }}</td>
                                        <td>{{ $car->number }}</td>
                                        <td>{{ $car->user->name . ' ' . $car->user->last_name }}</td>
                                        <td>{{ $car->user->phone }}</td>
                                        <td hidden>{{ $car->user->id }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <input type="hidden" name="car_id" value="">
                            @error('car_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <h3>Работы</h3>
                        <div class="mb-3">
                            <label for="tasks" class="form-label">Выберите работы <span
                                    class="text-danger">*</span></label>
                            <table class="table" id="tasks">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 3em">ID</th>
                                    <th scope="col" class="d-sm-none d-md-table-cell">Категория</th>
                                    <th scope="col">Работа</th>
                                    <th scope="col" style="width: 3em">Время</th>
                                    <th scope="col" style="width: 3em">Цена нч, грн.</th>
                                    <th scope="col" style="width: 3em">Кол-во</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr class="{{ is_array(old('task_ids')) && in_array($task->id, old('task_ids')) ? ' selected' : '' }}">
                                        <td>{{ $task->id }}</td>
                                        <td class="d-sm-none d-md-table-cell">{{ $task->category->title }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            <select name="task_drs">
                                                @foreach($timeIntervals as $name => $value)
                                                    <option
                                                        value="{{ $value }}" {{ $value == $task->duration ? 'selected' : '' }}>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="task_prs"
                                                   value="{{ $task->price }}" style="width: 5em"></td>
                                        <td><input type="text" name="task_qts" value="1" style="width: 5em"></td>
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
                        <h3>Детали и материалы</h3>
                        <table class="table" id="parts">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 14em">Код</th>
                                <th scope="col">Наименование</th>
                                <th scope="col" style="width: 7em">Цена, грн.</th>
                                <th scope="col" style="width: 5em">Кол-во</th>
                                <th scope="col" style="width: 2em" class="text-center"><i class="fa-solid fa-trash"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(is_array(old('parts_titles')))
                                @foreach(old('parts_titles') as $index => $part)
                                    <tr>
                                        <td>
                                            <input id="code-{{ $index }}" type="text" class="form-control"
                                                   name="parts_codes[]"
                                                   value="{{ old('parts_codes')[$index] }}">
                                        </td>
                                        <td>
                                            <input id="title-{{ $index }}" type="text" class="form-control"
                                                   name="parts_titles[]"
                                                   value="{{ old('parts_titles')[$index] }}">
                                        </td>
                                        <td>
                                            <input id="price-{{ $index }}" type="text" class="form-control"
                                                   name="parts_prices[]"
                                                   value="{{ old('parts_prices')[$index] }}">
                                        </td>
                                        <td>
                                            <input id="qty-{{ $index }}" type="text" class="form-control"
                                                   name="parts_qts[]"
                                                   value="{{ old('parts_qts')[$index] }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-link del" id="{{ $index }}"><i
                                                    class="fa-solid fa-square-xmark link-dark"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="col mb-5">
                            <button type="button" class="btn btn-secondary ms-2" id="add-row"><i
                                    class="fa-solid fa-plus"></i>
                            </button>
                        </div>

                        @error('codes')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('titles')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('prices')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('qts')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="alert alert-danger" role="alert" id="parts_errors"
                             style="display: none">
                            Форма заполнена с ошибками!
                        </div>
                        <h3>Комментарий менеджера</h3>
                        <div class="mb-5">
                            <textarea class="form-control" name="note" id="note" rows="3" maxlength="999"
                                      placeholder="Максимальная длина комментария 1000 символов">{{ old('note') }}</textarea>
                            @error('note')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
        </div>
        <script>
            var taskIds;
            var taskQts;
            var taskPrs;
            var taskDrs;
            var table_tasks;
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
                var selectedCell = table_cars.row('.selected').index();

                table_cars.cell(selectedCell, 0).focus();

                var addCarHref = '{{ route('admin.users.cars.create', 'user_id_template') }}' + '?quickOrder=1';

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
                        userId = rowData[0][5];
                        href = addCarHref.replace('user_id_template', userId);
                        $("#add_car").attr('href', href);
                        $("#add_car").show('slow');
                    }
                }

                var table_tasks = $('#tasks').DataTable({
                    select: {
                        style: 'multi+shift',
                        selector: 'td:nth-child(1), td:nth-child(2), td:nth-child(3)',
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
                        {data: 'quantity'},
                    ],
                    stateSave: true,
                });

                getTableTasksData();

                $('#tasks tbody').on('change', 'td', function () {
                    var data = table_tasks.cell(this).data();
                    var name = data.match(/name="(\S+)"/);
                    if (name !== null) name = name[1];
                    if (name == 'task_prs' || name == 'task_qts') {
                        var value = table_tasks.cell(this).$("input[name='" + name + "']", this).val();
                        data = "<input type=\"text\" name=\"" + name + "\" value=\"" + value + "\" style=\"width: 5em\">";
                        table_tasks.cell(this).data(data);
                    } else if (name == 'task_drs') {
                        var value = table_tasks.cell(this).$("select[name='" + name + "']", this).val();
                        data = data.replace(" selected", "");
                        data = data.replace("value=\"" + value + "\"", "value=\"" + value + "\" selected");
                        table_tasks.cell(this).data(data);
                    }
                    getTableTasksData();
                });

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
                    item = item.replace('select', 'select hidden');
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

            $('#parts').on('click', '.del', function () {
                $(this).parent().parent().remove();
            });

            var i = {{ $index ?? 0}};
            $('#add-row').click(function () {
                i++;
                $('#parts').append(
                    "<tr><td><input id='code-" + i + "' type='text' class='form-control' name='parts_codes[]'></td>" +
                    "<td><input id='title-" + i + "' type='text' class='form-control' name='parts_titles[]'></td>" +
                    "<td><input id='price-" + i + "' type='text' class='form-control' name='parts_prices[]'></td>" +
                    "<td><input id='qty-" + i + "' type='text' class='form-control' name='parts_qts[]'</td>" +
                    "<td><button type='button' class='btn btn-link del' id='" + i + "'><i class='fa-solid fa-square-xmark link-dark'></i></button></td></tr>");
            });

            $('#parts').on('change', ':input', function () {
                id = $(this).attr('id').match(/\d+/)[0];
                if ($('#title-' + id).val() == '') {
                    $('#title-' + id).addClass('is-invalid');
                } else {
                    $('#title-' + id).removeClass('is-invalid');
                }
                if ($('#price-' + id).val() == '' || /^\d+$/.test($('#price-' + id).val()) == false) {
                    $('#price-' + id).addClass('is-invalid');
                } else {
                    $('#price-' + id).removeClass('is-invalid');
                }
                if ($('#qty-' + id).val() == '' || /^\d+$/.test($('#qty-' + id).val()) == false) {
                    $('#qty-' + id).addClass('is-invalid');
                } else {
                    $('#qty-' + id).removeClass('is-invalid');
                }
            });

            $('form').submit(function (event) {
                var err = false;
                $(':input').each(function () {
                    if ($(this).hasClass('is-invalid')) {
                        err = true;
                        return false;
                    }
                });
                if (err == false) {
                    return;
                } else {
                    $('#parts_errors').show('fast');
                    event.preventDefault();
                }
            });

        </script>
    </main>
    @include('admin.includes.footer')
@endsection
