@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Заказ ' . $order->id)
@section('header', 'Заказ ' . $order->id )
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('user.orders.index') }}">Заказы</a></li>
@endsection
@section('breadcrumb', 'Заказ')

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('user.includes.header')
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <h3>Автомобиль</h3>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="col" style="width: 19em">Марка и модель</th>
                            <td>{{ $order->car->model->brand->title . ' ' . $order->car->model->title . ' ' . $order->car->year }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Гос. номер</th>
                            <td>{{ $order->car->number }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Менеджер</th>
                            <td>{{ $order->user->name  . ' ' . $order->user->last_name}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Мастер</th>
                            <td>{{ isset($order->schedule) ? $order->schedule->master->first_name . ' ' . $order->schedule->master->last_name : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Дата и время начала работ</th>
                            <td>{{ isset($order->schedule) ? date('d.m.Y H:i', strtotime($order->schedule->start_time)) : '' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Длительность работ, часов</th>
                            <td>{{ $order->duration / 60}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Сумма заказа, грн.</th>
                            <td>{{ $order->price }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Заказ оплачен</th>
                            <td>{!! $order->is_paid ? "<span class='badge bg-success state me-4'>Оплачен</span>" : "<span class='badge bg-secondary state me-4'>Не оплачен</span>" !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 mb-5">
                    <h3>Статусы заказа</h3>
                    <table class="table" id="states">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col" style="width: 11em">Дата и время</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->states as $key => $state)
                            <tr {!! $key == last($order->states) ? "" : "class='text-black-50'" !!}>
                                <td>{{ $state->title }}</td>
                                <td>{{ $state->pivot->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($order->states->first()->id == 1)
                        <a href="{{ route('user.orders.cancel', $order->id) }}"
                           class="btn btn-danger">Отменить заказ</a>
                    @endif
                    <div class="mt-5">
                        <h3 class="mb-3">Отзыв</h3>
                        @if(isset($order->feedback->rating))
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Оценка:
                                        @for($i=1;$i<=5; $i++)
                                            {!! $i <= $order->feedback->rating ? "<span class='star'>★</span>" : "<span class='star-empty'>☆</span>" !!}
                                        @endfor
                                    </h5>
                                    {{ $order->feedback->review }}
                                </div>
                            </div>
                        @else
                            <a class="btn btn-secondary btn-sm {{ isset($order->states->first()->id) && $order->states->first()->id == 3 ? '' : 'disabled' }}"
                               data-bs-toggle="collapse" href="#collapseFeedback"
                               role="button" aria-expanded="false" aria-controls="collapseFeedback">Добавить отзыв</a>
                            <div class="collapse mt-3" id="collapseFeedback">
                                <div class="card card-body">
                                    <form
                                        action="{{ route('user.orders.feedbacks.store', $order->id) }}"
                                        method="post">
                                        @csrf
                                        <textarea class="form-control" name="review" id="review" rows="5"
                                                  maxlength="999"
                                                  placeholder="Текст отзыва">{{ old('review', $order->review) }}</textarea>
                                        @error('review')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <label class="rating">Оценка</label>
                                        <span class="star-cb-group">
                                        <input type="radio" id="rating-5" name="rating" value="5"/><label
                                                for="rating-5">5</label>
                                        <input type="radio" id="rating-4" name="rating" value="4"
                                               checked="checked"/><label
                                                for="rating-4">4</label>
                                        <input type="radio" id="rating-3" name="rating" value="3"/><label
                                                for="rating-3">3</label>
                                        <input type="radio" id="rating-2" name="rating" value="2"/><label
                                                for="rating-2">2</label>
                                        <input type="radio" id="rating-1" name="rating" value="1"/><label
                                                for="rating-1">1</label>
{{--                                        <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear"/><label for="rating-0">0</label>--}}
                                    </span>
                                        <button type="submit" class="btn btn-secondary btn-sm mt-3 float-end">Добавить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <h3>Перечень работ</h3>
            <table class="table mb-5">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">Арт.</th>
                    <th scope="col" style="width: 15em">Категория работ</th>
                    <th scope="col">Наименование работы</th>
                    <th scope="col">Время, ч.</th>
                    <th scope="col">Цена нч, грн.</th>
                    <th scope="col">Кол-во</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->tasks->sortBy('category.title') as $task)
                    <tr>

                        <td>{{ $task->id }}</td>
                        <td>{{ $task->category->title }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->pivot->duration / 60 }}</td>
                        <td>{{ $task->pivot->price }}</td>
                        <td>{{ $task->pivot->quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-12 mb-5">
                <a href="{{ route('user.orders.index') }}" class="btn btn-secondary me-2">Назад</a>
                @if(isset($order->states->first()->id) && $order->states->first()->id == 1)
                    <a href="{{ route('user.orders.edit', $order->id) }}"
                       class="btn btn-warning me-2"><i
                            class="fa-solid fa-pen"></i></a>
                @endif
            </div>
        </div>
    </main>
    @include('user.includes.footer')
@endsection
