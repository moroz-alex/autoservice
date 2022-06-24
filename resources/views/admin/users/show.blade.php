@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Пользователь ' . $user->name . ' ' . $user->last_name)
@section('header', 'Пользователь' )
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
@endsection
@section('breadcrumb', $user->name . ' ' . $user->last_name)

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <a href="#" class="btn btn-warning mb-3 me-2">Изменить пароль</a>
            <a href="{{ route('users.cars.index', $user->id) }}" class="btn btn-info mb-3">Автомобили</a>
            <table class="table">
                <tbody>
                <tr>
                    <th scope="col" style="width: 15em">ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Имя</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th scope="col">Фамилия</th>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <th scope="col">Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th scope="col">Телефон</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th scope="col">Роль</th>
                    <td>
                        {{ $roles[$user->role] }}</td>
                </tr>
                </tbody>
            </table>
            <div class="col-12">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Назад</a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning me-2"><i
                        class="fa-solid fa-pen"></i></a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" style="display:inline">
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
