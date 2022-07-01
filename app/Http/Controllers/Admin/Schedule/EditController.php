<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Models\Order;

class EditController extends Controller
{
    public function __invoke(Order $order)
    {
        $mastersList = ScheduleService::getMastersList($order);
        $timeSlots = ScheduleService::getTimeSlots($order, $mastersList);
        $timeSlotsNumber = ScheduleService::getTimeSlotsNumber();
        $disableDays = ScheduleService::getDisabledDays();

        return view('admin.schedules.edit', compact('order', 'timeSlots', 'timeSlotsNumber', 'mastersList', 'disableDays'));
    }
}
