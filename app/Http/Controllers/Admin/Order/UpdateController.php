<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();

        if (isset($data['task_ids'])) {
            $orderPrice = 0;
            $orderDuration = 0;
            foreach ($data['task_ids'] as $index => $task) {
                $orderTasks[$task] = [
                    'quantity' => $data['task_qts'][$index],
                    'duration' => $data['task_drs'][$index],
                    'price' => $data['task_prs'][$index],
                ];
                $orderPrice += $data['task_qts'][$index] * $data['task_prs'][$index];
                $orderDuration += $data['task_qts'][$index] * $data['task_drs'][$index];
            }
            unset($data['task_ids']);
            unset($data['task_qts']);
        } else {
            $orderTasks = [];
        }

        $orderData = [
            'car_id' => $data['car_id'],
            'duration' => $orderDuration,
            'price' => $orderPrice,
            'is_confirmed' => '0',
            'user_id' => '2',  // Заменить на текущего менеджера
            'is_done' => '0',
            'is_paid' => '0',
        ];

        $order->update($orderData);
        $order->tasks()->sync($orderTasks);

        return redirect()->route('admin.orders.index');
    }
}
