@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Заказы клиента ' . $user->name . ' ' . $user->last_name)
@section('header', 'Заказы' )
@section('breadcrumb', 'Заказы клиента')

@section('scriptTop')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('user.includes.header')
            <a href="{{ route('user.orders.create') }}" class="btn btn-primary mb-3">Добавить заказ</a>
            <table class="table table-hover" id="orders">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">№ заказа</th>
                    <th scope="col" style="width: 7em">Дата и время работ</th>
                    <th scope="col">Автомобиль</th>
                    <th scope="col">Работы</th>
                    <th scope="col" style="width: 3em">Время, часов</th>
                    <th scope="col" style="width: 4em">Сумма, грн.</th>
                    <th scope="col" style="width: 6em">Статус</th>
                    <th scope="col" style="width: 1em">Оплата</th>
                    <th scope="col" style="width: 8em">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr id="{{ $order->id }}">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->schedule->start_time ?? '' }}</td>
                        <td>{{ $order->car->model->brand->title . ' ' . $order->car->model->title . ' ' . $order->car->year}}
                            <br>VIN: {{ $order->car->vin ?? '-' }}<br>г/н: {{ $order->car->number ?? '-' }}</td>
                        <td>
                            @foreach($order->tasks->sortBy('category.title') as $task)
                                <span class="text-black-50">{{ $task->category->title }}: </span>{{ $task->title }} <br>
                            @endforeach
                        </td>
                        <td>
                            {{ $order->duration / 60}}
                        </td>
                        <td>
                            {{ $order->price }}
                        </td>
                        <td>
                            <span class="badge state state-{{ $order->states->first()->id ?? '0' }}">
                                {{ $order->states->first()->title ?? '' }}
                            </span>
                        </td>
                        <td>
                            {!! $order->is_paid ? "<span class='badge bg-success state'>Оплачен</span>" : "<span class='badge bg-secondary state'>Нет оплаты</span>" !!}
                        </td>
                        <td>
                            <a href="{{ route('user.orders.show', $order->id) }}"
                               class="me-2"><i class="fa-solid fa-eye link-dark"></i></a>
                            @if(isset($order->states->first()->id) && $order->states->first()->id == 1)
                                <a href="{{ route('user.orders.edit', $order->id) }}"
                                   class="me-2"><i class="fa-solid fa-pen link-dark"></i></a>
                            @endif
                            @if(isset($order->states->first()->id) && $order->states->first()->id == 1 && (!isset($order->schedule->start_time) || $order->schedule->has_error))
                                <a href="{{ route('user.schedules.edit', $order->id) }}" class="me-2"><i
                                        class="fa-solid fa-calendar-check text-danger"
                                        title="{{ !isset($order->schedule->start_time) ? 'Заказ не добавлен в расписание!' : 'Ошибка в расписании!' }}"></i></a>

                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
        <script>
            var url = "{{ route('user.orders.show', 'orderId') }}";
            $('#orders tbody tr').click(function () {
                id = $(this).attr('id').match(/\d+/)[0];
                window.location.href = url.replace('orderId', id);
            });
        </script>
    </main>
    @include('user.includes.footer')
@endsection
