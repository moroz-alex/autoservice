@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Автомобили клиента ' . $user->name . ' ' . $user->last_name)
@section('header', 'Автомобили' )
@section('breadcrumb', 'Автомобили клиента')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('user.includes.header')
            <a href="{{ route('user.cars.create') }}" class="btn btn-primary">Добавить автомобиль</a>
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
                        <td><a href="{{ route('user.cars.show', $car->id) }}" class="link-dark text-decoration-none">{{ $car->model->brand->title}}</a></td>
                        <td><a href="{{ route('user.cars.show', $car->id) }}" class="link-dark text-decoration-none">{{ $car->model->title }}</a></td>
                        <td>{{ $car->year}}</td>
                        <td>{{ $car->number }}</td>
                        <td>
                            <a href="{{ route('user.cars.show', $car->id) }}" class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            <a href="{{ route('user.cars.edit', $car->id) }}" class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            @if(!$car->hasOrders)
                            <form action="{{ route('user.cars.destroy', $car->id) }}" method="post" style="display:inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-light" style="display: contents">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            @else
                                <i class="fa-solid fa-trash text-black-50" title="Есть заказы, удаление невозможно"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $cars->links() }}
        </div>
    </main>
    @include('user.includes.footer')
@endsection
