@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Настройки')
@section('header', 'Настройки')

@section('breadcrumb', 'Настройки')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            @if(!empty(session()->get('status')))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session()->get('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12 mb-3">
                    <form action="{{ route('admin.settings.update') }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Название организации <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="company_name" id="company_name"
                                   placeholder="Введите название организации"
                                   value="{{ !empty(old('company_name')) ? old('company_name') : $settings->company_name }}">
                            @error('company_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   placeholder="Введите адрес"
                                   value="{{ !empty(old('address')) ? old('address') : $settings->address }}">
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phones" class="form-label">Телефон(ы)</label>
                            <input type="text" class="form-control" name="phones" id="phones"
                                   placeholder="Введите номера телефонов через запятую"
                                   value="{{ !empty(old('phones')) ? old('phones') : $settings->phones }}">
                            @error('phones')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email"
                                   placeholder="Введите адрес электронной почты"
                                   value="{{ !empty(old('email')) ? old('email') : $settings->email }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="work_days" class="form-label">Рабочие дни <span
                                    class="text-danger">*</span></label>
                            <select multiple size="7" class="form-select form-control" id="work_days"
                                    name="work_days[]">
                                @foreach($days as $id => $day)
                                    <option value="{{ $id }}"
                                        {{ in_array($id, $settings->work_days) ? ' selected' : '' }}
                                    >{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('work_days')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Время работы (с - по) <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-2">
                                    <select class="form-select form-control" id="schedule_start" name="schedule_start">
                                        @for($h = 0; $h < 24; $h++)
                                            <option value="{{ $optionHour = ($h < 10 ? '0' : '') . $h . ':00:00' }}"
                                                {{$optionHour == $settings->schedule_start ? ' selected' : ''}}
                                            >{{ $h . ':00' }}</option>
                                        @endfor
                                    </select>
                                    @error('schedule_start')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-2">
                                    <select class="form-select form-control" id="schedule_end" name="schedule_end">
                                        @for($h = 0; $h < 24; $h++)
                                            <option value="{{ $optionHour = ($h < 10 ? '0' : '') . $h . ':00:00' }}"
                                                {{$optionHour == $settings->schedule_end ? ' selected' : ''}}
                                            >{{ $h . ':00' }}</option>
                                        @endfor
                                    </select>
                                    @error('schedule_end')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="api_key" class="form-label">API ключ сервиса AUTO RIA <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="api_key" id="api_key"
                                   placeholder="Введите API ключ"
                                   value="{{ !empty(old('api_key')) ? old('api_key') : $settings->api_key }}">
                            @error('api_key')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="id" value="{{ $settings->id }}">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
    </main>
    @include('admin.includes.footer')
@endsection
