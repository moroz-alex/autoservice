@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Добавление нового мастера')
@section('header', 'Добавить мастера')
@section('breadcrumb', 'Добавление мастера')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.masters.index') }}">Мастера</a></li>
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

            <div class="row mb-5">
                <div class="col-12">
                    <form action="{{ route('admin.masters.store') }}" method="post" name="masters">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Имя <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                   placeholder="Введите имя мастера"
                                   value="{{ old('first_name') }}">
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                   placeholder="Введите фамилию мастера"
                                   value="{{ old('last_name') }}">
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch mt-2 mb-5">
                            <input type="hidden" name="is_available" value="0">
                            <input type="checkbox" role="switch" class="form-check-input" checked id="is_available"
                                   name="is_available"
                                   value="1"/>
                            <label for="is_available" class="form-check-label">Мастер доступен</label>
                            @error('is_available')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tasks" class="form-label">Выполняемые работы</label>
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
                                    <tr class="{{ is_array(old('task_ids')) && in_array($task->id, old('task_ids')) ? ' selected' : '' }}">
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
                        <button type="submit" class="btn btn-primary">Добавить</button>
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

                table
                    .on('select', function (e, dt, type, indexes) {
                        taskIds = table.rows('.selected').data().pluck('id').toArray();
                    })
                    .on('deselect', function (e, dt, type, indexes) {
                        taskIds = table.rows('.selected').data().pluck('id').toArray();
                    });
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
