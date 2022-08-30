@extends('user.layouts.main')

@section('title', 'МойАвтосервис : Добавление заказа в расписание')
@section('header', 'Добавить заказ в расписание')
@section('breadcrumb', 'Добавление заказа в расписание')
@section('breadcrumb_subcat')
    <li class="breadcrumb-item"><a href="{{ route('user.orders.index') }}">Заказы</a></li>
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
            @include('user.includes.header')

            <div class="row">
                <div class="col-12 mb-5">
                    <form action="{{ route('user.schedules.store') }}" method="post" name="schedules">
                        @csrf
                        <div class="mb-3">
                            <label for="schedules" class="form-label">Выберите желаемую дату и время<span
                                    class="text-danger">*</span></label>
                            <div class="fs-4 fw-bold mb-2">
                                Дата: <input type="text" id="pageInfoDate" name="date" value="{{ date('d.m.Y', array_key_first($timeSlotsForClient)) }}"
                                             readonly>
                            </div>
                            <table class="table compact hover cell-border" id="schedules">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 5em" hidden>Дата</th>
                                    <th scope="col" style="width: 5em">Время</th>
                                    <th scope="col">Выберите</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($timeSlotsForClient as $time => $state)
                                    <tr>
                                        <td hidden>{{ date('Y-m-d H:i', $time) }}</td>
                                        <td>{{ date('H:i', $time) }}</td>
                                        @if($state == 'unusable')
                                            <td class="table-secondary text-muted protected">
                                                Недоступно
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
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
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('user.orders.edit', $order->id) }}" class="btn btn-secondary ms-2">Назад</a>
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
                    maxDate: new Date('{{ date('Y-m-d', strtotime('+1 month')) }}'),
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
                        zeroRecords: 'Дата не найдена',
                        infoEmpty: 'Дата не найдена',
                        infoFiltered: '(отфильтровано из _MAX_ записей)',
                        search: 'Поиск даты ',
                        select: {
                            rows: ""
                        },
                    },
                });

                table
                    .on('select', function () {
                        getTableData();
                    });

                $('#schedules_filter').hide();

                selectedDate = moment($('#pageInfoDate').val(), 'DD.MM.YYYY').format('YYYY-MM-DD');
                table.search(selectedDate).draw();

                $('#pageInfoDate').on('change', function () {
                    var searchDate = moment(this.value, 'DD.MM.YYYY').format('YYYY-MM-DD');
                    table.search(searchDate).draw();
                });

                function getTableData() {
                    date = table.cell(table.cell({selected: true}).index().row, 0).data();

                    $("input[name='start_time']").val(date);
                }
            });
        </script>
    </main>
    @include('user.includes.footer')
@endsection
