@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Добавление работы')
@section('header', 'Добавить работу')
@section('breadcrumb', 'Добавление работы')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.tasks.index') }}">Работы</a></li>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.tasks.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Код работы</label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="Введите код работы"
                                   value="{{ old('code') }}" maxlength="20">
                            @error('code')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Название работы <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Введите название работы"
                                   value="{{ old('title') }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category">Категория <span class="text-danger">*</span></label>
                            <select class="form-select form-control" id="category" name="category_id">
                                <option value="">Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id') ? ' selected' : '' }}
                                    >{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Продолжительность работы <span class="text-danger">*</span></label>
                            <select class="form-select form-control" id="duration" name="duration">
                                <option value="">Укажите плановую продолжительность работы</option>
                                @foreach($timeIntervals as $name => $value)
                                <option value="{{ $value }}" {{ $value == old('duration') ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Стоимость нормочаса <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="price" id="price" placeholder="Введите стоимость нормочаса в гривнах"
                                   value="{{ old('price') }}">
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <div class="form-check form-switch mt-2">
                                <input type="hidden" name="is_available_to_customer" value="0">
                                <input type="checkbox" role="switch" class="form-check-input" id="is_available_to_customer" name="is_available_to_customer" value="1"/>
                                <label for="is_available_to_customer" class="form-check-label">Доступно для самостоятельного заказа клиентом</label>
                            </div>
                            @error('is_available_to_customer')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
    </main>
    @include('admin.includes.footer')
@endsection
