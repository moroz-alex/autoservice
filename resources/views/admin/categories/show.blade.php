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
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning me-2"><i class="fa-solid fa-pen"></i></a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" style="display:inline">
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
