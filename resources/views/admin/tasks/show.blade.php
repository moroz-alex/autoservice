@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Типовая работа ' . $task->title)
@section('header', $task->title )
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.tasks.index') }}">Работы</a></li>
@endsection
@section('breadcrumb', $task->title)

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            @if(!empty(session()->get('error')))
                <div class="alert alert-danger mt-3" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif

            <table class="table">
                <tbody>
                <tr>
                    <th scope="col" style="width: 15em">Артикул</th>
                    <td>{{ $task->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Категория работы</th>
                    <td>{{ $task->category->title }}</td>
                </tr>
                <tr>
                    <th scope="col">Наименование работы</th>
                    <td>{{ $task->title }}</td>
                </tr>
                <tr>
                    <th scope="col">Длительность, нормочасов</th>
                    <td>{{ $task->duration / 60 }}</td>
                </tr>
                <tr>
                    <th scope="col">Цена нормочаса, гривен</th>
                    <td>{{ $task->price }}</td>
                </tr>
                <tr>
                    <th scope="col">Цена работы, гривен</th>
                    <td>{{ $task->price * $task->duration / 60 }}</td>
                </tr>
                </tbody>
            </table>
            <div class="col-12">
            <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary me-2">Назад</a>
            <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-warning me-2"><i class="fa-solid fa-pen"></i></a>
            <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="post" style="display:inline">
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
