@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Редактирование категории')
@section('header', 'Редактировать категорию')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Категории работ</a></li>
@endsection
@section('breadcrumb', 'Редактирование категории: ' . $category->title)

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="title" class="form-label">Название работы <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Введите название работы"
                                   value="{{ !empty(old('title')) ? old('title') : $category->title }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
