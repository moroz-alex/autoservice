@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : модели автомобилей>' . $brand->title)
@section('header', 'Модели автомобилей марки ' . $brand->title)
@section('breadcrumb', $brand->title)
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Марки автомобилей</a></li>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">ID</th>
                    <th scope="col">Марка</th>
                    <th scope="col">Модель</th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->brand->title }}</td>
                        <td>{{ $model->title }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $models->links() }}
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Назад</a>
        </div>
    </main>
    @include('admin.includes.footer')
@endsection
