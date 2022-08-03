@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Автомобили пользователя')
@section('header', 'Автомобили пользователя ' . $user->last_name . ' ' . $user->name)
@section('breadcrumb', 'Автомобили пользователя')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a
            href="{{ route('admin.users.index') }}">{{ 'Пользователи' }}</a>
    </li>
    <li class="breadcrumb-item"><a
            href="{{ route('admin.users.show', $user->id) }}">{{ 'Пользователь ' . $user->last_name . ' ' . $user->name }}</a>
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
                        <td>{{ $car->model->brand->title}}</td>
                        <td><a href="{{ route('admin.users.cars.show',['user' => $user->id, 'car' => $car->id]) }}" class="link-dark text-decoration-none">{{ $car->model->title }}</a></td>
                        <td>{{ $car->year}}</td>
                        <td>{{ $car->number }}</td>
                        <td>
                            <a href="{{ route('admin.users.cars.show',['user' => $user->id, 'car' => $car->id]) }}" class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            <a href="{{ route('admin.users.cars.edit',['user' => $user->id, 'car' => $car->id]) }}" class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            <form action="{{ route('admin.users.cars.destroy', ['user' => $user->id, 'car' => $car->id]) }}" method="post" style="display:inline">
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
            <div class="col-12">
                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary me-2">Назад</a>
            </div>
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
