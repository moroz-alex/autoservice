<?php

namespace App\Http\Controllers\User\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class EditController extends Controller
{
    public function __invoke(User $user, Order $order)
    {
        if (isset($order->states->first()->id) && $order->states->first()->id != 1) {
            return redirect()->route('user.orders.index', $user->id);
        }

        $mastersList = ScheduleService::getMastersList($order);
        $timeSlotsForClient = ScheduleService::getTimeSlotsForClient($order, $mastersList);
        $timeSlotsNumber = ScheduleService::getTimeSlotsNumber();
        $disableDays = ScheduleService::getDisabledDays();

        return view('user.schedules.edit', compact('user', 'order', 'timeSlotsForClient', 'timeSlotsNumber', 'disableDays'));
    }
}
