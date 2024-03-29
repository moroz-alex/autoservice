@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Перечень категорий типовых работ')
@section('header', 'Категории работ')
@section('breadcrumb', 'Категории работ')

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
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Добавить категорию</a>
            @endcan
            <table class="table" id="categories">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">Арт.</th>
                    <th scope="col">Категория работ</th>
                    <th scope="col" style="width: 3em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><a href="{{ route('admin.categories.show', $category->id) }}"
                               class="link-dark text-decoration-none">{{ $category->title }}</a></td>
                        <td>
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="me-2"><i
                                    class="fa-solid fa-eye link-dark"></i></a>
                            @can('view', auth()->user())
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="me-2"><i
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
                $('#categories').DataTable({
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Категорий не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Категорий не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ категорий)',
                        search: 'Поиск категории ',
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
