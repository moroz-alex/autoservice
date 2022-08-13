<?php

namespace App\Http\Controllers\Admin\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        if (isset($data['state'])) {
            $data['state'] = [
                [
                    'state_id' => $data['state'],
                    'user_id' => 2, // TODO Заменить на текущего менеджера
                ]
            ];
        }

        $order = OrderService::update($data, $order);

        if ($order->tasksChanged || !isset($order->schedule->start_time) || $order->schedule->has_error) {
            return redirect()->route('admin.schedules.edit', compact('order'));
        } else {
            return redirect()->route('admin.orders.index');
        }
    }
}
