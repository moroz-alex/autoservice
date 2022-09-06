@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col contacts mb-5">
                    <h1>Контактные данные</h1>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $companyName }}</h5>
                            <p><strong>Адрес:</strong> {{ $address }}</p>
                            <p><strong>Телефоны:</strong> {{ $phones }}</p>
                            <p><strong>Email:</strong> <a class="text-black" href="mailto:{{ $email }}">{{ $email }}</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
