@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Добавление категории работ')
@section('header', 'Добавить категорию работ')
@section('breadcrumb', 'Добавление категории работ')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Категории работ</a></li>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.categories.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Название категории <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Введите название категории работ"
                                   value="{{ old('title') }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
    </main>
    @include('admin.includes.footer')
@endsection
