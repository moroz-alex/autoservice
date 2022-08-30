@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Редактирование клиента ' . $user->name . ' ' . $user->last_name)
@section('header', 'Редактирование клиента')
@section('breadcrumb', 'Редактирование данных клиента')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('user.show') }}">Данные клиента</a></li>
@endsection

@section('scriptTop')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('user.includes.header')
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('user.update') }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Введите имя пользователя"
                                   value="{{ !empty(old('name')) ? old('name') : $user->name }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                   placeholder="Введите фамилию пользователя"
                                   value="{{ !empty(old('last_name')) ? old('last_name') : $user->last_name }}">
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="Введите емейл пользователя"
                                   value="{{ !empty(old('email')) ? old('email') : $user->email }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                   placeholder="Введите номер телефона"
                                   value="{{ !empty(old('phone')) ? old('phone') : $user->phone }}">
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <script>
                                $(document).ready(function () {
                                    $("#phone").mask("+38 (999) 999-99-99");
                                });
                            </script>
                        </div>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{ route('user.show') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>

        </div>
    </main>
    @include('user.includes.footer')
@endsection
