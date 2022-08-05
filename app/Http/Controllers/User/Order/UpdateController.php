<?php

namespace App\Http\Controllers\User\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\UpdateRequest;
use App\Models\Order;
use App\Models\User;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user, Order $order)
    {
        $data = $request->validated();
        dd($data);
        $order = OrderService::update($data, $order);

        if ($order->tasksChanged || !isset($order->schedule->start_time)) {
//            return redirect()->route('user.schedules.edit', compact('order'));
        } else {
            return redirect()->route('user.orders.index', $user->id);
        }
    }
}
