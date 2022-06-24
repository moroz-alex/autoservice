@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Редактирование работы')
@section('header', 'Редактировать работу')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.tasks.index') }}">Работы</a></li>
@endsection
@section('breadcrumb', 'Редактирование работы: ' . $task->title)

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.tasks.update', $task->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="title" class="form-label">Название работы <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Введите название работы"
                                   value="{{ !empty(old('title')) ? old('title') : $task->title }}">
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
                                        {{ $category->id == $task->category->id ? ' selected' : '' }}
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
                                    <option value="{{ $value }}"
                                        @if(!empty(old('duration')))
                                            {{ $value == old('duration') ? ' selected' : '' }}
                                        @else
                                            {{ $value == $task->duration ? ' selected' : '' }}
                                        @endif
                                    >{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Стоимость нормочаса <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="price" id="price"
                                   placeholder="Введите стоимость нормочаса в гривнах"
                                   value="{{ !empty(old('price')) ? old('price') : $task->price }}">
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
    </main>
    @include('admin.includes.footer')
@endsection
