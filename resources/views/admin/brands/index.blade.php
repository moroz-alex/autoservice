@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : База моделей автомобилей>')
@section('header', 'Модели автомобилей')
@section('breadcrumb', 'Модели автомобилей')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            @if(!empty(session()->get('status')))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session()->get('status') }}
                </div>
            @else
                <div class="row">
                    <div class="col-6">
                        <form action="{{ route('admin.models.store') }}" method="post">
                            @csrf
                            <button class="btn btn-secondary">
                                Обновить список всех марок и моделей
                            </button>
                        </form>
                    </div>
                    <div class="col-6 text-end">Последнее обновление моделей: {{ $lastUpdate }}</div>
                </div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">ID</th>
                    <th scope="col">Марка</th>
                    <th scope="col" style="width: 6em">Количество моделей</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td><a href="{{ route('admin.brands.show', $brand->id) }}"
                               class="link-dark text-decoration-none">{{ $brand->title }}</a></td>
                        <td>{{ $brand->models_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $brands->links() }}
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
