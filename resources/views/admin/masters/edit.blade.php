@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Редактирование мастера')
@section('header', 'Редактировать мастера ' . $master->first_name . ' ' . $master->last_name)
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.masters.index') }}">Мастера</a></li>
@endsection
@section('breadcrumb', 'Редактирование мастера')

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
                    <form action="{{ route('admin.masters.update', $master->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Имя <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                   placeholder="Введите имя мастера"
                                   value="{{ !empty(old('first_name')) ? old('first_name') : $master->first_name }}">
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                   placeholder="Введите фамилию мастера"
                                   value="{{ !empty(old('last_name')) ? old('last_name') : $master->last_name }}">
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="function" class="form-label">Должность</label>
                            <input type="text" class="form-control" name="function" id="function"
                                   placeholder="Введите должность мастера"
                                   value="{{ !empty(old('function')) ? old('function') : $master->function }}">
                            @error('function')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch mt-2 mb-5">
                            <input type="hidden" name="is_available" value="0">
                            <input type="checkbox" role="switch" class="form-check-input"
                                   {{ $master->is_available ? 'checked' : '' }} id="is_available" name="is_available"
                                   value="1"/>
                            <label for="is_available" class="form-check-label">Мастер доступен</label>
                            @error('is_available')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <h3>Выполняемые работы</h3>
                            <table class="table" id="tasks">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 4em">ID</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Работа</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr class="{{ is_array($master->tasks->pluck('id')->toArray()) && in_array($task->id, $master->tasks->pluck('id')->toArray()) ? ' selected' : '' }}">
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->category->title }}</td>
                                        <td>{{ $task->title }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div id="taskId">
                            </div>

                            @error('task_ids')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{ route('admin.masters.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <script>
            var taskIds;
            $(document).ready(function () {
                var events = $('#events');
                var table = $('#tasks').DataTable({
                    select: {
                        style: 'multi+shift'
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
                    ]
                });

                table.rows('.selected').select();
                getTableTasksData();

                table
                    .on('select', function (e, dt, type, indexes) {
                        getTableTasksData();
                    })
                    .on('deselect', function (e, dt, type, indexes) {
                        getTableTasksData();
                    });

                function getTableTasksData() {
                    taskIds = table.rows('.selected').data().pluck('id').toArray();
                }
            });
            $("form").submit(function () {
                var res = "";
                taskIds.forEach(function (item, i, taskIds) {
                    res = res + "<input type='hidden' name='task_ids[" + i + "]' value='" + item + "'>";
                });
                document.getElementById('taskId').innerHTML = res;
            });
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
