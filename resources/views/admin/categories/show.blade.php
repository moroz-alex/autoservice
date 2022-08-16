@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Категория ' . $category->title)
@section('header', $category->title )
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Категории работ</a></li>
@endsection
@section('breadcrumb', $category->title)

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <div class="row mb-5">
                <div class="col">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="col" style="width: 15em">ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Наименование категории</th>
                            <td>{{ $category->title }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-12">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary me-2">Назад</a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning me-2"><i
                                class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post"
                              style="display:inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <h3>Работы в категории</h3>
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
                        @foreach($category->tasks as $task)
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
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
