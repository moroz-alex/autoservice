@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Редактирование работ')
@section('header', 'Редактировать работы заказа ' . $order->id)
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.show', $order->id) }}">Заказ {{ $order->id }}</a></li>
@endsection
@section('breadcrumb', 'Редактирование работ')

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
                    <form action="{{ route('admin.orders.tasks.update', $order->id) }}" method="post" name="orders">
                        @csrf
                        @method('patch')
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
                                    <tr
                                        @if(is_array(old('task_ids')) && in_array($task->id, old('task_ids')))
                                        class='selected'
                                        @elseif(!is_array(old('task_ids')) && isset($task->selected))
                                        class='selected'
                                        @endif>
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
                                        <td><input type="text" name="task_qts" value="{{ $task->quantity ?? 1 }}"
                                                   style="width: 5em"></td>
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
                        <div class="alert alert-warning text-danger" role="alert" id="tasks_change_alert"
                             style="display: none">
                            Внимание! После изменения работ в заказе обязательно проверьте расписание!
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary ms-2">Назад</a>
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
                    keys: true,
                });

                table_tasks.rows('.selected').select();
                getTableTasksData();

                var selectedCell = table_tasks.row('.selected').index();
                table_tasks.cell(selectedCell, 0).focus();

                $('#tasks tbody').on('change', 'td', function () {
                    var data = table_tasks.cell(this).data();
                    var name = data.match(/name="(\S+)"/);
                    if (name !== null) name = name[1];
                    if (name == 'task_prs' || name == 'task_qts') {
                        var value = table_tasks.cell(this).$("input[name='" + name + "']", this).val();
                        data = "<input type=\"text\" name=\"" + name + "\" value=\"" + value + "\" style=\"width: 5em\">";
                        table_tasks.cell(this).data(data);
                    } else if (name == 'task_drs') {
                        var value = table_tasks.cell(this).$("select[name='" + name + "']", this).val()
                        data = data.replace(" selected", "");
                        data = data.replace("value=\"" + value + "\"", "value=\"" + value + "\" selected");
                        table_tasks.cell(this).data(data);
                    }
                    getTableTasksData();
                });

                table_tasks
                    .on('select', function (e, dt, type, indexes) {
                        getTableTasksData();
                        $('#tasks_change_alert').show('fast');
                    })
                    .on('deselect', function (e, dt, type, indexes) {
                        getTableTasksData();
                        $('#tasks_change_alert').show('fast');
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
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
