<?php

namespace App\Http\Controllers\User\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Schedule\UpdateRequest;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user, Order $order)
    {
        $data = $request->validated();
        if (!isset($data['master_id'])) {
            $data['master_id'] = ScheduleService::distributeOrderAmongMasters($order, $data['start_time']);
        }

        $schedule = Schedule::where('order_id', $order->id)->first();

        if (isset($schedule)) {
            $schedule->update($data);
        } else {
            Schedule::create($data);
        }

        return  redirect()->route('user.orders.index', $user->id);
    }
}
