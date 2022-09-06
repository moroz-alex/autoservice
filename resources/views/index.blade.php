@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="main-logo" style="margin-top: 20%">
                <div class="text-center" style="font-size: 55px">
                    <i class="fa-solid fa-car-side" style="position: relative; top: 5px; margin-right: 5px;"></i> МойАвтосервис
                </div>
                <div class="text-center">
                    Система управления заказами СТО
                </div>
            </div>
            <div class="mt-5 text-center text-secondary">
                <h3 class="mb-3">Демонстрационные учетные данные</h3>
                <p>Интерфейс клиента: логин - client@client, пароль - 123123123 (либо зарегистрируйтесь)</p>
                <p>Интерфейс менеджера: логин - manager@manager, пароль - 123123123</p>
                <p>Интерфейс администратора: логин - admin@admin, пароль - 123123123</p>
            </div>
        </div>
    </div>
@endsection
