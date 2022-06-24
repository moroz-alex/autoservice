@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Мастер ' . $master->first_name . ' ' . $master->last_name)
@section('header', 'Мастер ' . $master->first_name )
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.masters.index') }}">Мастера</a></li>
@endsection
@section('breadcrumb', $master->first_name . ' ' . $master->last_name)

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <h3>Данные мастера</h3>
            <table class="table mb-5">
                <tbody>
                <tr>
                    <th scope="col" style="width: 15em">ID</th>
                    <td>{{ $master->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Имя</th>
                    <td>{{ $master->first_name }}</td>
                </tr>
                <tr>
                    <th scope="col">Фамилия</th>
                    <td>{{ $master->last_name }}</td>
                </tr>
                </tbody>
            </table>

            <h3>Выполняемые работы</h3>
            <table class="table mb-5">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">Арт.</th>
                    <th scope="col" style="width: 15em">Категория работ</th>
                    <th scope="col">Наименование работы</th>
                </tr>
                </thead>
                <tbody>
                @foreach($master->tasks->sortBy('category.title') as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->category->title }}</td>
                        <td><a href="{{ route('admin.tasks.show', $task->id) }}"
                               class="link-dark text-decoration-none">{{ $task->title }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-12">
                <a href="{{ route('admin.masters.index') }}" class="btn btn-secondary me-2">Назад</a>
                <a href="{{ route('admin.masters.edit', $master->id) }}" class="btn btn-warning me-2"><i
                        class="fa-solid fa-pen"></i></a>
                <form action="{{ route('admin.masters.destroy', $master->id) }}" method="post" style="display:inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
