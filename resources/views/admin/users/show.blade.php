@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : ' . ( auth()->user()->role == 2 ? 'пользователь ' : 'клиент ') . $user->name . ' ' . $user->last_name)
@section('header', auth()->user()->role == 2 ? 'Пользователь' : 'Клиент')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ auth()->user()->role == 2 ? 'Пользователи' : 'Клиенты' }}</a></li>
@endsection
@section('breadcrumb', $user->name . ' ' . $user->last_name)

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            @if(!empty(session()->get('error')))
                <div class="alert alert-danger mt-3" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif

            <a href="{{ route('admin.users.cars.index', $user->id) }}" class="btn btn-info mb-3">Автомобили</a>
            <table class="table">
                <tbody>
                <tr>
                    <th scope="col" style="width: 15em">ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Имя</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th scope="col">Фамилия</th>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <th scope="col">Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th scope="col">Телефон</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th scope="col">Роль</th>
                    <td>
                        {{ $roles[$user->role] }}</td>
                </tr>
                </tbody>
            </table>
            <div class="col-12 mb-5">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Назад</a>
                @if(!(auth()->user()->role == 1 && $user->role != 0))
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning me-2"><i
                            class="fa-solid fa-pen"></i></a>
                @endif
                @can('view', auth()->user())
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" style="display:inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                @endcan
            </div>
            <h3>Заказы клиента</h3>
            <table class="table mb-5" id="orders">
                <thead>
                <tr>
                    <th scope="col" style="width: 4em">№ заказа</th>
                    <th scope="col" style="width: 7em">Дата и время работ</th>
                    <th scope="col">Автомобиль</th>
                    <th scope="col">Работы</th>
                    <th scope="col" style="width: 3em">Время, часов</th>
                    <th scope="col" style="width: 4em">Сумма, грн.</th>
                    <th scope="col" style="width: 6em">Статус</th>
                    <th scope="col" style="width: 1em">$</th>
                    <th scope="col" style="width: 6em">Действия</th>
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
                            <span class="badge state state-{{ $order->states->last()->id ?? '0' }}">
                                {{ $order->states->last()->title ?? '' }}
                            </span>
                        </td>
                        <td style="color: #E0E0E0">
                            <i class="fa-solid fa-sack-dollar {{ $order->is_paid ? 'text-success' : '' }}"
                               title="Заказ{{ $order->is_paid ? '' : ' не' }} оплачен"></i>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="me-2"><i
                                    class="fa-solid fa-eye link-dark"></i></a>
                            @if(!isset($order->schedule->start_time) || $order->schedule->has_error)
                                <a href="{{ route('admin.schedules.edit', $order->id) }}" class="me-2"><i
                                        class="fa-solid fa-calendar-check text-danger"
                                        title="{{ !isset($order->schedule->start_time) ? 'Заказ не добавлен в расписание!' : 'Ошибка в расписании!' }}"></i></a>

                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function () {
                $('#orders').DataTable({
                    order: [[1, 'desc']],
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Заказов не найдено',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Заказов не найдено',
                        infoFiltered: '(отфильтровано из _MAX_ заказов)',
                        search: 'Поиск заказа ',
                        paginate: {
                            "next": "Вперед",
                            "previous": "Назад"
                        },
                    },
                });
            });
            var url = "{{ route('admin.orders.show', 'orderId') }}";
            $('#orders tbody tr').click(function () {
                id = $(this).attr('id').match(/\d+/)[0];
                window.location.href = url.replace('orderId', id);
            });
        </script>
    </main>
    @include('admin.includes.footer')
@endsection
