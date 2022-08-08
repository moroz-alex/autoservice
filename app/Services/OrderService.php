<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderTask;
use App\Models\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Facades\ScheduleService;

class OrderService
{
    public function getOrderSelectedTasks(Order $order)
    {
        $tasks = Task::all();
        $orderTasksIds = $order->tasks->pluck('id')->toArray();
        foreach ($tasks as $task) {
            if (is_array($orderTasksIds) and in_array($task->id, $orderTasksIds)) {
                $task->selected = true;
                foreach ($order->tasks as $orderTask) {
                    if ($task->id == $orderTask->id) {
                        $task->price = $orderTask->pivot->price;
                        $task->duration = $orderTask->pivot->duration;
                        $task->quantity = $orderTask->pivot->quantity;
                        break;
                    }
                }
            }
        }
        return $tasks;
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['task_ids'])) {
                $data = $this->getOrderTasks($data);
            }

            $orderData = $this->createOrderData($data);

            $order = Order::create($orderData);;
            if (isset($data['orderTasks'])) {
                $order->tasks()->attach($data['orderTasks']);
            }

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка добавления заказа');
        }

    }

    public function update($data, $order)
    {
        try {
            DB::beginTransaction();

            if (isset($data['task_ids'])) {
                $data = $this->getOrderTasks($data);
            } else {
                $data['orderTasks'] = [];
            }

            $orderData = $this->createOrderData($data);
            $order->tasksChanged = $this->checkOrderTasksChanges($data, $order);

            $order->update($orderData);
            $order->tasks()->sync($data['orderTasks']);

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка обновления данных заказа');
        }
    }

    private function createOrderData($data)
    {
        return [
            'car_id' => $data['car_id'],
            'duration' => $data['orderDuration'],
            'price' => $data['orderPrice'],
            'is_confirmed' => '0',
            'user_id' => '2',  // Заменить на текущего менеджера
            'is_done' => $data['is_done'] ?? '0',
            'is_paid' => $data['is_paid'] ?? '0',
        ];
    }

    private function getOrderTasks($data)
    {
        $data['orderPrice'] = 0;
        $data['orderDuration'] = 0;
        foreach ($data['task_ids'] as $index => $task_id) {
            $data['orderTasks'][$task_id] = [
                'quantity' => $data['task_qts'][$index],
                'duration' => $data['task_drs'][$index],
                'price' => $data['task_prs'][$index],
            ];
            $data['orderPrice'] += $data['task_qts'][$index] * $data['task_prs'][$index] * ($data['task_drs'][$index] / 60);
            $data['orderDuration'] += $data['task_qts'][$index] * $data['task_drs'][$index];
        }
        return $data;
    }

    public function checkOrderTasksChanges($data, $order)
    {
        $orderOldData = OrderTask::select('task_id', 'quantity', 'duration', 'price')->where('order_id', $order->id)->get()->toArray();
        foreach ($data['orderTasks'] as $id =>$task) {
            $tasks[] = [
                'task_id' => $id,
                'quantity' => (int)$task['quantity'],
                'duration' => (int)$task['duration'],
                'price' => (int)$task['price'],
                ];
        }
        sort($tasks);
        sort($orderOldData);

        return $tasks != $orderOldData;
    }

    public function checkOrdersSchedule($orders)
    {
        foreach ($orders as $order) {
            $order->is_schedule_errors = ScheduleService::checkOrderScheduleFit($order);
        }
        return $orders;
    }
}
