@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Перечень мастеров')
@section('header', 'Мастера')
@section('breadcrumb', 'Мастера')

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4 mb-5">
            @include('admin.includes.header')
            @can('view', auth()->user())
                <a href="{{ route('admin.masters.create') }}" class="btn btn-primary mb-3">Добавить мастера</a>
            @endcan
            <table class="table" id="masters">
                <thead>
                <tr>
                    <th scope="col" style="width: 3em">ID.</th>
                    <th scope="col" style="width: 14em">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Должность</th>
                    <th scope="col" style="width: 10em">Доступность</th>
                    <th scope="col" style="width: 3em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($masters as $master)
                    <tr>
                        <td>{{ $master->id }}</td>
                        <td><a href="{{ route('admin.masters.show', $master->id) }}"
                               class="link-dark text-decoration-none">{{ $master->first_name }}</a></td>
                        <td><a href="{{ route('admin.masters.show', $master->id) }}"
                               class="link-dark text-decoration-none">{{ $master->last_name }}</a></td>
                        <td><a href="{{ route('admin.masters.show', $master->id) }}"
                               class="link-dark text-decoration-none">{{ $master->function }}</a></td>
                        <td><span
                                class="badge {{ $master->is_available ? 'bg-success' : 'bg-danger' }}">{{ $master->is_available ? 'Доступен' : 'Недоступен' }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.masters.show', $master->id) }}" class="me-2"><i
                                    class="fa-solid fa-eye link-dark"></i></a>
                            @can('view', auth()->user())
                                <a href="{{ route('admin.masters.edit', $master->id) }}" class="me-2"><i
                                        class="fa-solid fa-pen link-dark"></i></a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function () {
                $('#masters').DataTable({
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Мастеров не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Мастеров не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ мастеров)',
                        search: 'Поиск мастера ',
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
