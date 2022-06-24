@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Автомобиль ' . $car->model->title)
@section('header', 'Автомобиль ' . $car->model->title)
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a
            href="{{ route('admin.users.index') }}">{{ 'Пользователи' }}</a>
    </li>
    <li class="breadcrumb-item"><a
            href="{{ route('admin.users.show', $car->user->id) }}">{{ 'Пользователь ' . $car->user->last_name . ' ' . $car->user->name }}</a>
    </li>
@endsection
@section('breadcrumb', $car->model->title)

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <table class="table">
                <tbody>
                <tr>
                    <th scope="col" style="width: 15em">ID</th>
                    <td>{{ $car->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Имя владельца</th>
                    <td>{{ $car->user->name . ' ' . $car->user->last_name }}</td>
                </tr>
                <tr>
                    <th scope="col">Марка</th>
                    <td>{{ $car->model->brand->title }}</td>
                </tr>
                <tr>
                    <th scope="col">Модель</th>
                    <td>{{ $car->model->title }}</td>
                </tr>
                <tr>
                    <th scope="col">Год выпуска</th>
                    <td>{{ $car->year }}</td>
                </tr>
                <tr>
                    <th scope="col">Гос. номер</th>
                    <td>{{ $car->number }}</td>
                </tr>
                <tr>
                    <th scope="col">VIN-код</th>
                    <td>
                        {{ $car->vin }}</td>
                </tr>
                </tbody>
            </table>
            <div class="col-12">
                <a href="{{ route('users.cars.index', $car->user->id) }}" class="btn btn-secondary me-2">Назад</a>
                <a href="#" class="btn btn-warning me-2"><i
                        class="fa-solid fa-pen"></i></a>
                <form action="#" method="post" style="display:inline">
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
