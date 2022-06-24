@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Перечень категорий типовых работ')
@section('header', 'Категории работ')
@section('breadcrumb', 'Категории работ')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Добавить категорию</a>
            <table class="table">
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
                        <td><a href="{{ route('admin.categories.show', $category->id) }}" class="link-dark text-decoration-none">{{ $category->title }}</a></td>
                        <td>
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" style="display:inline">
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
