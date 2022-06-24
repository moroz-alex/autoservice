@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Добавление заказа в расписание')
@section('header', 'Добавить заказ в расписание')
@section('breadcrumb', 'Добавление заказа в расписание')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="#">Расписание</a></li>
@endsection

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12 mb-5">
                    <form action="{{ route('admin.schedules.store') }}" method="post" name="schedules">
                        @csrf
                        <div class="mb-3">
                            <label for="schedules" class="form-label">Выберите свободное время и мастера<span
                                    class="text-danger">*</span></label>
                            <div id="pageInfo" class="fs-3 fw-bold"></div>
                            <table class="table compact hover cell-border" id="schedules">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 5em" hidden>Дата</th>
                                    <th scope="col" style="width: 5em">Время</th>
                                    @foreach($mastersList as $master)
                                        <th scope="col">{{ $master->last_name . ' ' . $master->first_name }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($timeSlots as $time => $masters)
                                    <tr>
                                        <td hidden>{{ date('Y-m-d\TH:i', $time) }}</td>
                                        <td>{{ date('H:i', $time) }}</td>
                                        @foreach($masters as $master => $state)
                                            @if($state == 'unusable')
                                                <td class="table-secondary text-muted protected">{{ date('H:i', $time) }}
                                                    Недоступно
                                                </td>
                                            @elseif($state == 'used')
                                                <td class="table-warning protected">{{ date('H:i', $time) }} Занято</td>
                                            @else
                                                <td><span hidden>{{ $master }}</span></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            @error('order_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="hidden" name="start_time">
                            @error('start_time')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="hidden" name="duration" value="{{ $order->duration }}">
                            @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="hidden" name="master_id">
                            @error('master_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <script>
            $(document).ready(function () {
                var events = $('#events');
                var table = $('#schedules').DataTable({
                    select: {
                        style: 'single',
                        selector: 'td:not(:nth-child(2),.protected)',
                        items: 'cell',
                        info: false,
                        toggleable: false,
                    },
                    stateSave: true,
                    searching: false,
                    lengthChange: false,
                    pageLength: {{ $timeSlotsNumber }},
                    ordering: false,
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Дата не найдена',
                        info: 'Страница _PAGE_ из _PAGES_',
                        infoEmpty: 'Дата не найдена',
                        infoFiltered: '(отфильтровано из _MAX_ дат)',
                        search: 'Поиск даты ',
                        paginate: {
                            "next": "Вперед",
                            "previous": "Назад"
                        },
                        select: {
                            rows: ""
                        },
                    },
                    {{--                    columns: [--}}
                    {{--                        {data: 'date'},--}}
                    {{--                        {data: 'time'},--}}
                    {{--                        @foreach($masters as $master)--}}
                    {{--                            {data: {{$master->id}} },--}}
                    {{--                        @endforeach--}}
                    {{--                    ],--}}
                    // dom: '<"top"p<"clear">>rt<"bottom"iflp<"clear">>',
                });

                var info = table.page.info();
                date = new Date(table.cell(info.start, 0).data());
                $('#pageInfo').html('Дата: ' + date.toLocaleDateString('ru-RU'));

                table
                    .on('select', function (e, dt, type, indexes) {
                        master = table.cell({selected: true}).data();
                        master = master.match(/>(\d+)</);
                        if (master !== null) master = master[1];
                        date = table.cell(table.cell({selected: true}).index().row, 0).data();
                        date = date.replace('T', ' ');
                        // table.cell({ selected: true }).data(master);
                        $("input[name='start_time']").val(date);
                        $("input[name='master_id']").val(master);
                    });

                $('#schedules').on('page.dt', function () {
                    var info = table.page.info();
                    date = new Date(table.cell(info.start, 0).data());
                    $('#pageInfo').html('Дата: ' + date.toLocaleDateString('ru-RU'));
                });

            });

        </script>
    </main>
    @include('admin.includes.footer')
@endsection
