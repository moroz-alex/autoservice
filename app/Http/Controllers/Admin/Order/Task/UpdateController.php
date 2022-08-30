<?php

namespace App\Http\Controllers\Admin\Order\Task;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\Task\UpdateRequest;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        $order = OrderService::updateOrderTasks($data, $order);

        if ($order->tasksChanged || !isset($order->schedule->start_time) || $order->schedule->has_error) {
            return redirect()->route('admin.schedules.edit', compact('order'));
        } else {
            return redirect()->route('admin.orders.show', $order->id);
        }
    }
}
