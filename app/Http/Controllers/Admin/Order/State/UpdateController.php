<?php

namespace App\Http\Controllers\Admin\Order\State;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\State\UpdateRequest;
use App\Models\Order;
use App\Notifications\CancelledOrderUserNotification;
use App\Notifications\ConfirmedOrderUserNotification;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();

        $order = OrderService::updateOrderState($data, $order);

        if ($data['state'] == 4) {
            $order->user->notify(new CancelledOrderUserNotification($order->id));
        }

        if ($data['state'] == 2) {
            $order->user->notify(new ConfirmedOrderUserNotification($order->id, $order->schedule->start_time ?? null));
        }

        return redirect()->route('admin.orders.show', $order->id);
    }
}
