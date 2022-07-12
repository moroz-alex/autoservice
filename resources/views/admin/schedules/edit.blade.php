@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : Редактирование расписания заказа')
@section('header', 'Редактировать расписание заказа ' . $order->id)
@section('breadcrumb', 'Редактирования расписания заказа')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="#">Расписание</a></li>
@endsection

@section('scriptTop')
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            @include('admin.includes.header')

            <div class="row">
                <div class="col-12 mb-5">
                    <form action="{{ route('admin.schedules.update', $order->id) }}" method="post" name="schedules">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="schedules" class="form-label">Выберите дату, свободное время и мастера<span
                                    class="text-danger">*</span></label>
                            <div class="fs-4 fw-bold mb-2">
                                Дата: <input type="text" id="pageInfoDate" name="date"
                                             value="{{ isset($order->schedule) ? date('d.m.Y', strtotime($order->schedule->start_time)) : date('d.m.Y') }}"
                                             readonly>
                            </div>
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
                                        <td hidden>{{ date('Y-m-d H:i', $time) }}</td>
                                        <td>{{ date('H:i', $time) }}</td>
                                        @foreach($masters as $master => $state)
                                            @if($state == 'unusable')
                                                <td class="protected
                                                    @if(isset($order->schedule) && $time == strtotime($order->schedule->start_time) && $order->schedule->master_id == $master)
                                                    bg-danger text-white">{{ date('H:i', $time) }}
                                                    НЕКОРРЕКТНОЕ ВРЕМЯ
                                                    @else
                                                        table-secondary text-muted">{{ date('H:i', $time) }}
                                                        Недоступно
                                                    @endif
                                                </td>
                                            @elseif($state == 'used')
                                                <td class="table-warning protected">{{ date('H:i', $time) }}
                                                    Занято
                                                </td>
                                            @else
                                                <td class="{{ isset($order->schedule) && $time == strtotime($order->schedule->start_time) && $order->schedule->master_id == $master ? 'selected' : '' }}"><span hidden>{{ $master }}</span></td>
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
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-secondary ms-2">Назад</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <script>
            $(document).ready(function () {
                var selectedDate;

                selectedDate = new DateTime($('#pageInfoDate'), {
                    format: 'DD.MM.YYYY',
                    i18n: {
                        previous: 'Предыдущий',
                        next: 'Следующий',
                        months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                        weekdays: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                    },
                    minDate: new Date('{{ date('Y-m-d') }}'),
                    maxDate: new Date('{{ date('Y-m-d', strtotime('+1 month -1 day')) }}'),
                    disableDays: [{{ $disableDays }}],
                });

                var table = $('#schedules').DataTable({
                    select: {
                        style: 'single',
                        selector: 'td:not(:nth-child(2),.protected)',
                        items: 'cell',
                        info: false,
                        toggleable: false,
                    },
                    searching: true,
                    lengthChange: false,
                    paging: false,
                    ordering: false,
                    info: false,
                    language: {
                        lengthMenu: 'Показать _MENU_ строк',
                        zeroRecords: 'Свободного времени в выбранную дату не найдено. Выберите другую дату.',
                        infoEmpty: 'Дата не найдена',
                        infoFiltered: '(отфильтровано из _MAX_ записей)',
                        search: 'Поиск даты ',
                        select: {
                            rows: ""
                        },
                    },
                });

                table.cells('.selected').select();

                table
                    .on('select', function () {
                        master = table.cell({selected: true}).data();
                        master = master.match(/>(\d+)</);
                        if (master !== null) master = master[1];
                        date = table.cell(table.cell({selected: true}).index().row, 0).data();

                        $("input[name='start_time']").val(date);
                        $("input[name='master_id']").val(master);
                    });

                $('#schedules_filter').hide();

                selectedDate = moment($('#pageInfoDate').val(), 'DD.MM.YYYY').format('YYYY-MM-DD');
                table.search(selectedDate).draw();

                $('#pageInfoDate').on('change', function () {
                    var searchDate = moment(this.value, 'DD.MM.YYYY').format('YYYY-MM-DD');
                    table.search(searchDate).draw();
                });

            });

        </script>
    </main>
    @include('admin.includes.footer')
@endsection
