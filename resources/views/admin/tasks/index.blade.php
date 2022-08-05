@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Типовые работы')
@section('header', 'Типовые работы')
@section('breadcrumb', 'Типовые работы')

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary mb-3">Добавить работу</a>
            <table class="table" id="tasks">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">Арт.</th>
                    <th scope="col" style="width: 15em">Категория работ</th>
                    <th scope="col">Наименование работы</th>
                    <th scope="col" style="width: 4em">Нормо-часы</th>
                    <th scope="col" style="width: 6em">Цена нормочаса</th>
                    <th scope="col" style="width: 6em">Цена работы</th>
                    <th scope="col" style="width: 3em">Доступно клиенту</th>
                    <th scope="col" style="width: 3em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->category->title }}</td>
                        <td><a href="{{ route('admin.tasks.show', $task->id) }}" class="link-dark text-decoration-none">{{ $task->title }}</a></td>
                        <td>{{ $task->duration / 60 }}</td>
                        <td>{{ $task->price }} <span class="text-secondary">грн.</span></td>
                        <td>{{ $task->price * $task->duration / 60 }} <span class="text-secondary">грн.</span></td>
                        <td>{!! $task->is_available_to_customer ? "<i class=\"fa-solid fa-circle-check\"></i>" : "" !!}</td>
                        <td>
                            <a href="{{ route('admin.tasks.show', $task->id) }}" class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            <a href="{{ route('admin.tasks.edit', $task->id) }}" class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="post" style="display:inline">
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
                $('#tasks').DataTable({
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Работ не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Работ не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ работ)',
                        search: 'Поиск работы ',
                        paginate: {
                            "next": "Вперед",
                            "previous": "Назад"
                        },
                    },
                    pageLength: 25,
                });
            });
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
