@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Заказ ' . $order->id)
@section('header', 'Заказ ' . $order->id )
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
@endsection
@section('breadcrumb', $order->id)

@section('scriptTop')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <h3>Автомобиль</h3>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="col" style="width: 10em">Марка и модель</th>
                            <td>{{ isset($order->car) && isset($order->car->model) && isset($order->car->model->brand) ? $order->car->model->brand->title . ' ' . $order->car->model->title . ' ' . $order->car->year : '' }}
                                <a href="{{ route('admin.orders.car.edit', $order->id) }}"
                                   class="btn btn-secondary btn-sm ms-2" title="Изменить авто"><i
                                        class="fa-solid fa-pen"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Гос. номер</th>
                            <td>{{ isset($order->car) ? $order->car->number : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">VIN-код</th>
                            <td>{{ isset($order->car) ? $order->car->vin : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Клиент</th>
                            <td>{{ isset($order->car) && isset($order->car->user) ? $order->car->user->name . ' ' . $order->car->user->last_name : ''}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Телефон клиента</th>
                            <td>{{ isset($order->car) && isset($order->car->user) ? $order->car->user->phone : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Менеджер</th>
                            <td>{{ isset($order->car) && isset($order->car->user) ? $order->user->name  . ' ' . $order->user->last_name : ''}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Мастер</th>
                            <td>{{ isset($order->schedule) && isset($order->schedule->master) ? $order->schedule->master->first_name . ' ' . $order->schedule->master->last_name : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Начало работ</th>
                            <td>{{ isset($order->schedule) ? date('d.m.Y H:i', strtotime($order->schedule->start_time)) : '' }}
                                <a href="{{ route('admin.schedules.edit', $order->id) }}"
                                   class="btn btn-secondary btn-sm ms-2" title="Изменить расписание"><i
                                        class="fa-solid fa-calendar-days"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Длительность</th>
                            <td>{{ intdiv($order->duration, 60) > 0 ? intdiv($order->duration, 60) . ' ч.' : '' }} {{ $order->duration % 60 != 0 ? $order->duration % 60 . ' мин.' : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Сумма заказа</th>
                            <td>{{ $order->price }} грн.</td>
                        </tr>
                        <tr>
                            <th scope="col">Заказ оплачен</th>
                            <td>{!! $order->is_paid ? "<span class='badge bg-success state me-4'>Оплачен</span>" : "<span class='badge bg-secondary state me-4'>Не оплачен</span>" !!}
                                <form id="is_paid_form" style="display:inline" action="{{ route('admin.orders.payment.update', $order->id) }}" method="post" class="mt-3">
                                    @csrf
                                    @method('patch')
                                    <div class="form-check form-switch" style="display: table-cell">
                                        <input type="hidden" name="is_paid" value="0">
                                        <input type="checkbox" role="switch" class="form-check-input"
                                               {{ $order->is_paid ? 'checked' : '' }} id="is_paid" name="is_paid"
                                               value="1" title="Изменить статус оплаты"/>
                                    </div>
                                    @error('note')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Отзыв клиента</th>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row">
                        <h3>Комментарий менеджера</h3>
                        <form action="{{ route('admin.orders.note.update', $order->id) }}" method="post" class="mt-3">
                            @csrf
                            @method('patch')
                            <textarea class="form-control" name="note" id="note" rows="5" maxlength="999"
                                      placeholder="Максимальная длина комментария 1000 символов">{{ old('note', $order->note) }}</textarea>
                            @error('note')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-secondary btn-sm mt-3 float-end">Обновить комментарий
                            </button>
                        </form>
                    </div>
                    <div class="row">
                        <h3>Статусы заказа</h3>
                        <table class="table" id="states">
                            <thead>
                            <tr>
                                <th scope="col">Статус</th>
                                <th scope="col" style="width: 11em">Дата и время</th>
                                <th scope="col" style="width: 15em">Автор</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->states as $key => $state)
                                <tr {!! $key == last($order->states) ? "" : "class='text-black-50'" !!}>
                                    <td>{{ $state->title }}</td>
                                    <td>{{ $state->pivot->created_at }}</td>
                                    <td>{{ $state->pivot->user->name ?? '' }} {{ $state->pivot->user->last_name ?? '' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <form action="{{ route('admin.orders.state.update', $order->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-select form-control" id="state" name="state">
                                        <option value="">Новый статус</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-secondary">Обновить статус</button>
                                </div>
                            </div>
                            @error('state')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>

            <h3>Перечень работ</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 15em">Категория работ</th>
                    <th scope="col">Наименование работы</th>
                    <th scope="col" style="width: 5em">Время, ч.</th>
                    <th scope="col" style="width: 7em">Цена нч, грн.</th>
                    <th scope="col" style="width: 5em">Кол-во</th>
                    <th scope="col" style="width: 7em">Стоимость, грн.</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->tasks->sortBy('category.title') as $task)
                    <tr>
                        <td>{{ $task->category->title }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->pivot->duration / 60 }}</td>
                        <td>{{ $task->pivot->price }}</td>
                        <td>{{ $task->pivot->quantity }}</td>
                        <td>{{ $task->pivot->price * $task->pivot->quantity * ($task->pivot->duration / 60) }}</td>
                    </tr>
                @endforeach
                <tr class="fw-bolder">
                    <td colspan="5">Итого, стоимость работ, грн.:</td>
                    <td>
                        {{ $totalTasks }}
                    </td>
                </tr>
                </tbody>
            </table>
            <a href="{{ route('admin.orders.tasks.edit', $order->id) }}" class="btn btn-secondary mb-5"
               title="Изменить работы"><i
                    class="fa-solid fa-pen"></i> Редактировать работы</a>

            <h3>Перечень деталей и материалов</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 15em">Код</th>
                    <th scope="col">Наименование</th>
                    <th scope="col" style="width: 7em">Цена, грн.</th>
                    <th scope="col" style="width: 5em">Кол-во</th>
                    <th scope="col" style="width: 7em">Сумма, грн.</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->parts as $part)
                    <tr>
                        <td>{{ $part->code }}</td>
                        <td>{{ $part->title }}</td>
                        <td>{{ $part->price }}</td>
                        <td>{{ $part->quantity }}</td>
                        <td>{{ $part->price * $part->quantity }}</td>
                    </tr>
                @endforeach
                <tr class="fw-bolder">
                    <td colspan="4">Итого, стоимость деталей и материалов, грн.:</td>
                    <td>
                        {{ $totalParts }}
                    </td>
                </tr>
                </tbody>
            </table>
            <a href="{{ route('admin.orders.parts.edit', $order->id) }}" class="btn btn-secondary mb-5"
               title="Изменить список деталей"><i
                    class="fa-solid fa-pen"></i> Редактировать детали</a>

            <div class="col-12 mb-5 d-flex justify-content-between">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary me-2"
                   title="Перейти к списку заказов">Назад</a>
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" style="display:inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" title="Удалить заказ">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>
    <script>
        $('#is_paid').change(function() {
            $('#is_paid_form').submit();
        });
    </script>
    @include('admin.includes.footer')
@endsection
