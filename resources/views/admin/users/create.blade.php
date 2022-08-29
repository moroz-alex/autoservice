@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Добавление нового пользователя')
@section('header', 'Добавить нового пользователя')
@section('breadcrumb', 'Добавление пользователя')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
@endsection

@section('scriptTop')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.users.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Введите имя пользователя"
                                   value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                   placeholder="Введите фамилию пользователя"
                                   value="{{ old('last_name') }}">
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="Введите емейл пользователя"
                                   value="{{ old('email') }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                   placeholder="Введите номер телефона"
                                   value="{{ old('phone') }}">
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <script>
                                $(document).ready(function() {
                                    $("#phone").mask("+38 (999) 999-99-99");
                                });
                            </script>
                        </div>
                        <div class="mb-3">
                            @if(auth()->user()->role == 1)
                                <input type="hidden" name="role" value="0">
                            @else
                                <label for="role">Роль <span class="text-danger">*</span></label>
                                <select class="form-select form-control" id="role" name="role">
                                    @foreach($userRoles as $id => $role)
                                        <option value="{{ $id }}"
                                        @if(!empty(old('role')))
                                            {{ $id == old('role') ? ' selected' : '' }}
                                            @else
                                            {{ $id == $user->role ? ' selected' : '' }}
                                            @endif
                                        >{{ $role }}</option>
                                    @endforeach
                                </select>
                            @endif
                            @error('role')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
    </main>
    @include('admin.includes.footer')
@endsection
