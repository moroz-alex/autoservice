@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Смена пароля клиента ' . $user->name . ' ' . $user->last_name)
@section('header', 'Изменить пароль')
@section('breadcrumb', 'Изменение пароля')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('user.show') }}">Данные клиента</a></li>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('user.includes.header')
            <div class="row">
                <div class="col-6">
                    <form action="{{ route('user.password.update') }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="password" class="form-label">Старый пароль <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Старый пароль"
                                   value="">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Новый пароль <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="new_password" id="new_password"
                                   placeholder="Старый пароль"
                                   value="">
                            @error('new_password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Подтверждение пароля <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="new_password_confirmation" id="password_confirmation"
                                   placeholder="Старый пароль"
                                   value="">
                            @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Изменить пароль</button>
                        <a href="{{ route('user.show') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>

        </div>
    </main>
    @include('user.includes.footer')
@endsection
