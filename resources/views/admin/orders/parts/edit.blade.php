@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Редактирование запчастей и материалов заказа')
@section('header', 'Редактировать детали и материалы заказа ' . $order->id)
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.show', $order->id) }}">Заказ {{ $order->id }}</a></li>
@endsection
@section('breadcrumb', 'Редактирование запчастей и материалов заказа')

@section('scriptTop')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <div class="row">
                <div class="col-12 mb-5">
                    <form action="{{ route('admin.orders.parts.update', $order->id) }}" method="post" name="parts">
                        @csrf
                        @method('patch')
                        <table class="table" id="parts">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 14em">Код</th>
                                <th scope="col">Наименование <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 8em">Цена, грн. <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 6em">Кол-во <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 2em" class="text-center"><i class="fa-solid fa-trash"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($order->parts->isNotEmpty())
                                @foreach($order->parts as $index => $part)
                                    <tr>
                                        <td>
                                            <input id="code-{{ $index }}" type="text" class="form-control"
                                                   name="parts_codes[]"
                                                   value="{{ $part->code ?? '' }}" maxlength="20">
                                        </td>
                                        <td>
                                            <input id="title-{{ $index }}" type="text" class="form-control"
                                                   name="parts_titles[]"
                                                   value="{{ $part->title ?? '' }}">
                                        </td>
                                        <td>
                                            <input id="price-{{ $index }}" type="text" class="form-control"
                                                   name="parts_prices[]"
                                                   value="{{ $part->price ?? '' }}">
                                        </td>
                                        <td>
                                            <input id="qty-{{ $index }}" type="text" class="form-control"
                                                   name="parts_qts[]"
                                                   value="{{ $part->quantity ?? '' }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-link del" id="{{ $index }}"><i
                                                    class="fa-solid fa-square-xmark link-dark"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="col mb-5">
                            <button type="button" class="btn btn-secondary ms-2" id="add-row"><i
                                    class="fa-solid fa-plus"></i>
                            </button>
                        </div>

                        @error('parts_codes')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('parts_titles')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('parts_prices')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('parts_qts')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="alert alert-danger" role="alert" id="parts_errors"
                             style="display: none">
                            Форма заполнена с ошибками!
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Сохранить</button>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>

        </div>
        <script>
            $('#parts').on('click', '.del', function () {
                $(this).parent().parent().remove();
            });

            var i = {{ $index ?? 0}};
            $('#add-row').click(function () {
                i++;
                $('#parts').append(
                    "<tr><td><input id='code-" + i + "' type='text' class='form-control' name='parts_codes[]' maxlength='20'></td>" +
                    "<td><input id='title-" + i + "' type='text' class='form-control' name='parts_titles[]'></td>" +
                    "<td><input id='price-" + i + "' type='text' class='form-control' name='parts_prices[]'></td>" +
                    "<td><input id='qty-" + i + "' type='text' class='form-control' name='parts_qts[]'</td>" +
                    "<td><button type='button' class='btn btn-link del' id='" + i + "'><i class='fa-solid fa-square-xmark link-dark'></i></button></td></tr>");
            });

            $('#parts').on('change', ':input', function () {
                id = $(this).attr('id').match(/\d+/)[0];
                if ($('#title-' + id).val() == '') {
                    $('#title-' + id).addClass('is-invalid');
                } else {
                    $('#title-' + id).removeClass('is-invalid');
                }
                if ($('#price-' + id).val() == '' || /^\d+$/.test($('#price-' + id).val()) == false) {
                    $('#price-' + id).addClass('is-invalid');
                } else {
                    $('#price-' + id).removeClass('is-invalid');
                }
                if ($('#qty-' + id).val() == '' || /^\d+$/.test($('#qty-' + id).val()) == false) {
                    $('#qty-' + id).addClass('is-invalid');
                } else {
                    $('#qty-' + id).removeClass('is-invalid');
                }
            });

            $('form').submit(function (event) {
                var err = false;
                $(':input').each(function () {
                    if ($(this).hasClass('is-invalid')) {
                        err = true;
                        return false;
                    }
                });
                if (err == false) {
                    return;
                } else {
                    $('#parts_errors').show('fast');
                    event.preventDefault();
                }
            });
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
