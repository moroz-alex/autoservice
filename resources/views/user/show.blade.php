@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Клиент ' . $user->name . ' ' . $user->last_name)
@section('header', $user->name . ' ' . $user->last_name )
@section('breadcrumb', 'Данные клиента')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('user.includes.header')
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
                </tbody>
            </table>
            <div class="col-12 mb-5">
                <a href="{{ route('user.edit') }}" class="btn btn-warning me-2"><i class="fa-solid fa-pen"></i></a>
                <a href="{{ route('user.password.edit') }}" class="btn btn-warning me-2">Изменить пароль</a>
            </div>
        </div>
    </main>
    @include('user.includes.footer')
@endsection
