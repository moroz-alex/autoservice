<?php

namespace App\Http\Controllers\Admin\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\StoreRequest;
use App\Notifications\NewOrderUserNotification;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $order = OrderService::store($data, 2);
        OrderService::updateOrderParts($order, $data);
        $order->car->user->notify(new NewOrderUserNotification($order->id));

        $request->session()->forget('carId');

        return redirect()->route('admin.schedules.create', compact('order'));
    }
}
