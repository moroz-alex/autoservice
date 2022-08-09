<?php

namespace App\Http\Controllers\User\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Arr;

class CreateController extends Controller
{
    public function __invoke(User $user, Order $order)
    {
        $mastersList = ScheduleService::getMastersList($order);
        $timeSlotsForClient = ScheduleService::getTimeSlotsForClient($order, $mastersList);
        $timeSlotsNumber = ScheduleService::getTimeSlotsNumber();
        $disableDays = ScheduleService::getDisabledDays();
        $mastersList = Arr::pluck($mastersList, 'id');

        return view('user.schedules.create', compact('user', 'order', 'mastersList', 'timeSlotsForClient', 'timeSlotsNumber', 'disableDays'));
    }
}
