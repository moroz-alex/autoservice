@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Типовые работы')
@section('header', 'Типовые работы')
@section('breadcrumb', 'Типовые работы')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">Добавить работу</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">Арт.</th>
                    <th scope="col" style="width: 15em">Категория работ</th>
                    <th scope="col">Наименование работы</th>
                    <th scope="col" style="width: 4em">Нормо-часы</th>
                    <th scope="col" style="width: 6em">Цена нормочаса</th>
                    <th scope="col" style="width: 6em">Цена работы</th>
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
    </main>
    @include('admin.includes.footer')
@endsection
