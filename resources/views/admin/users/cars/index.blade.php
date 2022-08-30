@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Автомобили ' . ( auth()->user()->role == 2 ? 'пользователя ' : 'клиента '))
@section('header', 'Автомобили ' . ( auth()->user()->role == 2 ? 'пользователя ' : 'клиента ') . $user->last_name . ' ' . $user->name)
@section('breadcrumb', 'Автомобили ' . ( auth()->user()->role == 2 ? 'пользователя ' : 'клиента '))
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a
            href="{{ route('admin.users.index') }}">{{ auth()->user()->role == 2 ? 'Пользователи' : 'Клиенты' }}</a>
    </li>
    <li class="breadcrumb-item"><a
            href="{{ route('admin.users.show', $user->id) }}">{{ (auth()->user()->role == 2 ? 'Пользователь ' : 'Клиент ') . $user->last_name . ' ' . $user->name }}</a>
    </li>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <a href="{{ route('admin.users.cars.create', $user->id) }}" class="btn btn-primary">Добавить автомобиль</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 3em">ID</th>
                    <th scope="col">Марка</th>
                    <th scope="col">Модель</th>
                    <th scope="col" style="width: 4em">Год</th>
                    <th scope="col" style="width: 8em">Номер</th>
                    <th scope="col" style="width: 3em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td><a href="{{ route('admin.users.cars.show',['user' => $user->id, 'car' => $car->id]) }}" class="link-dark text-decoration-none">{{ $car->model->brand->title}}</a></td>
                        <td><a href="{{ route('admin.users.cars.show',['user' => $user->id, 'car' => $car->id]) }}" class="link-dark text-decoration-none">{{ $car->model->title }}</a></td>
                        <td>{{ $car->year}}</td>
                        <td>{{ $car->number }}</td>
                        <td>
                            <a href="{{ route('admin.users.cars.show',['user' => $user->id, 'car' => $car->id]) }}" class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            <a href="{{ route('admin.users.cars.edit',['user' => $user->id, 'car' => $car->id]) }}" class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-12">
                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary me-2">Назад</a>
            </div>
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
