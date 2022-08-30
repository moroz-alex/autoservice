<?php

namespace App\Http\Controllers\User\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Models\Order;

class EditController extends Controller
{
    public function __invoke(Order $order)
    {
        if (isset($order->states->first()->id) && $order->states->first()->id != 1) {
            return redirect()->route('user.orders.index');
        }

        $mastersList = ScheduleService::getMastersList($order);
        $timeSlotsForClient = ScheduleService::getTimeSlotsForClient($order, $mastersList);
        $timeSlotsNumber = ScheduleService::getTimeSlotsNumber();
        $disableDays = ScheduleService::getDisabledDays();

        return view('user.schedules.edit', compact('order', 'timeSlotsForClient', 'timeSlotsNumber', 'disableDays'));
    }
}
