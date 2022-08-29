<?php

namespace App\Http\Controllers\User\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Models\Order;

class CreateController extends Controller
{
    public function __invoke(Order $order)
    {
        $mastersList = ScheduleService::getMastersList($order);
        $timeSlotsForClient = ScheduleService::getTimeSlotsForClient($order, $mastersList);
        $timeSlotsNumber = ScheduleService::getTimeSlotsNumber();
        $disableDays = ScheduleService::getDisabledDays();

        return view('user.schedules.create', compact('order', 'timeSlotsForClient', 'timeSlotsNumber', 'disableDays'));
    }
}
