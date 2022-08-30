@extends('layouts.app')

@section('title', 'МойАвтосервис : Подтверждение электронной почты')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Подтвердите ваш Email адрес</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Отправлено новое письмо со свежей ссылкой для подтверждения почты.') }}
                        </div>
                    @endif

                    {{ __('Прежде чем продолжить, вы должны подтвердить вашу электронную почту по ссылке, отправленной на указанный вами адрес.') }}
                    {{ __('Если вы не получили письмо') }}:
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">отправить повторно</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
