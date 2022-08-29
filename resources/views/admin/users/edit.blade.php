@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Редактирование пользователя ' . $user->name . ' ' . $user->last_name)
@section('header', 'Редактирование пользователя')
@section('breadcrumb', 'Редактирование пользователя ' . $user->name . ' ' . $user->last_name)
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
                    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
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
                            <label for="email" class="form-label">Email</label>
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
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
    </main>
    @include('admin.includes.footer')
@endsection
