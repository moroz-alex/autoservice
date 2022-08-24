<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>МойАвтосервис : Печать заказа {{ $order->id }}</title>
    <style>
        @media print {
            input {
                border: none;
                outline: none;
            }

            .print {
                display: none;
            }
        }

        h3 {
            margin: 0;
        }

        .client-data {
            margin: 2em 0 0;
        }

        .order-tasks {
            margin: 1em 0;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 0.2em;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        .total, .signs {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
            margin: 2em 2em 4em;
        }

        .header {
            margin: 0 auto 4em;
        }

        .logo {
            display: inline-block;
        }

        .title {
            display: inline-block;
            font-size: 24px;
            margin: 0 5px;
            position: fixed;
            top: 6px;
        }

        .details {
            display: inline-block;
            text-align: right;
            float: right;
        }

        .print {
            float: right;
        }

        .btn-back {
            font-size: 16px;
            padding: 7px 16px;
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
            cursor: pointer;
            border-radius: 0.25rem;
            margin-right: 10px;
        }

        .btn-print {
            font-size: 16px;
            padding: 7px 16px;
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
            cursor: pointer;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body style="font-family:sans-serif; font-size: 12px; width: 19cm">
<div class="header">
    <div class="logo">
        <img src="{{ asset('img/logo.svg') }}" alt="Мой автосервис лого" height="26px">
    </div>
    <div class="title">
        МойАвтосервис
    </div>
    <div class="details">
        {{ $companyName }}<br>{{ $address }}<br>{{ $phones }}
    </div>
</div>
<div style="font-size: 26px; text-align: center">Заказ-наряд № {{ $order->id }} от <input type="text"
                                                                                          value="{{ date('d.m.Y') }}"
                                                                                          size="6em"
                                                                                          style="font-size: 26px"></div>
<div class="client-data">
    <table>
        <tr>
            <th class="left" style="width: 9em">Заказчик</th>
            <td style="width: 40em">{{ isset($order->car) && isset($order->car->user) ? $order->car->user->name . ' ' . $order->car->user->last_name : ''}}</td>
        </tr>
        <tr>
            <th class="left">Телефон</th>
            <td>{{ isset($order->car) && isset($order->car->user) ? $order->car->user->phone : '' }}</td>
        </tr>
        <tr>
            <th class="left">Марка и модель</th>
            <td>{{ isset($order->car) && isset($order->car->model) && isset($order->car->model->brand) ? $order->car->model->brand->title . ' ' . $order->car->model->title : '' }}</td>
        </tr>
        <tr>
            <th class="left">VIN-код</th>
            <td>{{ isset($order->car) ? $order->car->vin : '' }}</td>
        </tr>
        <tr>
            <th class="left">Год выпуска</th>
            <td>{{ isset($order->car) ? $order->car->year : '' }}</td>
        </tr>
        <tr>
            <th class="left">Гос. номер</th>
            <td>{{ isset($order->car) ? $order->car->number : '' }}</td>
        </tr>
    </table>
</div>
<div class="order-tasks">
    <h3>Работы:</h3>
    <table style="width: 100%">
        <thead>
        <tr>
            <th style="width: 2em">№</th>
            <th style="width: 11em">Код</th>
            <th>Наименование работы</th>
            <th style="width: 3em">Кол-во</th>
            <th style="width: 4em">Норма времени, ч.</th>
            <th style="width: 5em">Стои-мость, грн.</th>
            <th style="width: 5em">Сумма, грн.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->tasks->sortBy('category.title') as $task)
            <tr>
                <td class="center">{{ $loop->index + 1 }}</td>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td class="center">{{ $task->pivot->quantity }}</td>
                <td class="center">{{ $task->pivot->duration / 60 }}</td>
                <td class="right">{{ $task->pivot->price * ($task->pivot->duration / 60) }}</td>
                <td class="right">{{ $task->pivot->price * $task->pivot->quantity * ($task->pivot->duration / 60) }}</td>
            </tr>
        @endforeach
        <tr class="bold">
            <td class="right" colspan="6">Итого, стоимость работ, грн.:</td>
            <td class="right">
                {{ $totalTasks }}
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="order-parts">
    <h3>Запчасти и материалы:</h3>
    <table style="width: 100%">
        <thead>
        <tr>
            <th style="width: 2em">№</th>
            <th style="width: 11em">Код</th>
            <th>Наименование</th>
            <th style="width: 3em">Кол-во</th>
            <th style="width: 5em">Цена, грн.</th>
            <th style="width: 5em">Сумма, грн.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->parts as $part)
            <tr>
                <td class="center">{{ $loop->index + 1 }}</td>
                <td>{{ $part->code }}</td>
                <td>{{ $part->title }}</td>
                <td class="center">{{ $part->quantity }}</td>
                <td class="right">{{ $part->price }}</td>
                <td class="right">{{ $part->price * $part->quantity }}</td>
            </tr>
        @endforeach
        <tr class="bold">
            <td class="right" colspan="5">Итого, стоимость запчастей и материалов, грн.:</td>
            <td class="right">
                {{ $totalParts }}
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="total">
    <p>Общая стоимость: {{ $totalTasks + $totalParts }} грн.</p>
</div>
<div class="signs">
    <p>Подпись клиента &nbsp;&nbsp;_______________</p>
    <br>
    <p>Подпись менеджера &nbsp;&nbsp;_______________</p>
</div>
<div class="print">
    <input type="button" class="btn-back" value="Назад" onclick="history.back();">
    <input type="button" class="btn-print" value="Печать" onclick="window.print();">
</div>
</body>
</html>
