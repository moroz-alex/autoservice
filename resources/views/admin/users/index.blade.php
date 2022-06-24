@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Пользователи')
@section('header', 'Пользователи')
@section('breadcrumb', 'Пользователи')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Добавить пользователя</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 3em">ID</th>
                    <th scope="col">Имя и фамилия</th>
                    <th scope="col" style="width: 15em">Email</th>
                    <th scope="col" style="width: 11em">Телефон</th>
                    <th scope="col" style="width: 8em">Роль</th>
                    <th scope="col" style="width: 3em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ route('admin.users.show', $user->id) }}" class="link-dark text-decoration-none">{{ $user->name . ' ' . $user->last_name }}</a></td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $roles[$user->role] }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" style="display:inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-light" style="display: contents">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </main>
    @include('admin.includes.footer')
@endsection
