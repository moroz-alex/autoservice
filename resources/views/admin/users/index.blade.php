@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Пользователи')
@section('header', 'Пользователи')
@section('breadcrumb', 'Пользователи')

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Добавить пользователя</a>
            <table class="table" id="users">
                <thead>
                <tr>
                    <th scope="col" style="width: 3em">ID</th>
                    <th scope="col">Имя и фамилия</th>
                    <th scope="col" style="width: 15em">Email</th>
                    <th scope="col" style="width: 11em">Телефон</th>
                    <th scope="col" style="width: 8em">Роль</th>
                    <th scope="col" style="width: 3em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ route('admin.users.show', $user->id) }}"
                               class="link-dark text-decoration-none">{{ $user->name . ' ' . $user->last_name }}</a>
                        </td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $roles[$user->role] }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="me-2"><i
                                    class="fa-solid fa-eye link-dark"></i></a>
                            @if(!(auth()->user()->role == 1 && $user->role != 0))
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="me-2"><i
                                        class="fa-solid fa-pen link-dark"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function () {
                $('#users').DataTable({
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Клиентов не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Клиентов не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ клиентов)',
                        search: 'Поиск клиента ',
                        paginate: {
                            "next": "Вперед",
                            "previous": "Назад"
                        },
                    },
                });
            });
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
