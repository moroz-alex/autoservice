@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Перечень мастеров')
@section('header', 'Мастера')
@section('breadcrumb', 'Мастера')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <a href="{{ route('admin.masters.create') }}" class="btn btn-primary">Добавить мастера</a>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 3em">ID.</th>
                    <th scope="col" style="width: 20em">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col" style="width: 3em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($masters as $master)
                    <tr>
                        <td>{{ $master->id }}</td>
                        <td><a href="{{ route('admin.masters.show', $master->id) }}" class="link-dark text-decoration-none">{{ $master->first_name }}</a></td>
                        <td><a href="{{ route('admin.masters.show', $master->id) }}" class="link-dark text-decoration-none">{{ $master->last_name }}</a></td>
                        <td>
                            <a href="{{ route('admin.masters.show', $master->id) }}" class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            <a href="{{ route('admin.masters.edit', $master->id) }}" class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            <form action="{{ route('admin.masters.destroy', $master->id) }}" method="post" style="display:inline">
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
