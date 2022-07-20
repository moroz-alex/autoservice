@extends('admin.layouts.main')

@section('title', 'МойАвтосервис : расписание')
@section('header', 'Расписание мастеров')
@section('breadcrumb', 'Расписание')

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
                    <div class="mb-3">
                        <div class="row">
                            <div class="fs-4 fw-bold mb-2 col-9">
                                Дата: <input type="text" id="pageInfoDate" name="date"
                                             value="{{ date('d.m.Y') }}"
                                             readonly>
                            </div>
                            <div class="col-3">
                                <a href="{{ route('admin.orders.create') }}" class="btn btn-primary float-end">Добавить заказ</a>
                            </div>
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
                                        <td align="center"
                                            class="{{ $state == 'used' || $state != 'unusable' && $state != 'free' ? 'table-warning' : '' }}"
                                            style="{{ $state == 'used' ? 'border-top:none; border-bottom-width:0px;' : '' }}">
                                            @if($state != 'used' && $state != 'unusable' && $state != 'free')
                                                <a href="{{ route('admin.orders.show', $state) }}"
                                                   class="link-dark text-decoration-none">Заказ {{$state}}</a>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
                    minDate: new Date('{{ date('Y-m-d', strtotime('-1 month')) }}'),
                    maxDate: new Date('{{ date('Y-m-d', strtotime('+1 month -1 day')) }}'),
                    disableDays: [{{ $disableDays }}],
                });

                var table = $('#schedules').DataTable({
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
