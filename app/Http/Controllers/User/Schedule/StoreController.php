<?php

namespace App\Http\Controllers\User\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Schedule\UpdateRequest;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;

class StoreController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $order = Order::find($data['order_id']);
        $data['master_id'] = ScheduleService::distributeOrderAmongMasters($order, $data['start_time']);

        Schedule::create($data);

        return redirect()->route('user.orders.index', $user->id);
    }
}
