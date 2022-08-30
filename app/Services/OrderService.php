<?php

namespace App\Services;

use App\Facades\ScheduleService;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\OrderTask;
use App\Models\Part;
use App\Models\Schedule;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

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

    public function store($data, $state)
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

            $data['state'] = [
                [
                    'state_id' => $state,
                    'user_id' => auth()->user()->id,
                ]
            ];
            $order->states()->attach($data['state']);


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

            if ($order->tasksChanged) {
                $order->tasks()->sync($data['orderTasks']);
                $schedule = Schedule::where('order_id', $order->id)->first();
                $schedule_errors = ScheduleService::checkOrderScheduleFit($order);
                if ($schedule) {
                    $schedule->update([
                        'duration' => $order->duration,
                        'has_error' => $schedule_errors,
                    ]);
                }
            }

            if (isset($data['state'])) {
                $data['state'] = [
                    [
                        'state_id' => $data['state'],
                        'user_id' => auth()->user()->id,
                    ]
                ];
                $order->states()->attach($data['state']);
            }

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
            'user_id' => auth()->user()->id,
            'is_paid' => $data['is_paid'] ?? '0',
            'note' => $data['note'] ?? '',
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
        foreach ($data['orderTasks'] as $id => $task) {
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

    public function updateOrderCar($data, $order)
    {
        try {
            DB::beginTransaction();

            $orderData = ['car_id' => $data['car_id']];
            $order->update($orderData);

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка обновления авто в заказе');
        }
    }

    public function updateOrderTasks($data, $order)
    {
        try {
            DB::beginTransaction();

            if (isset($data['task_ids'])) {
                $data = $this->getOrderTasks($data);
                foreach ($order->parts as $part) {
                    $data['orderPrice'] += $part->price * $part->quantity;
                }
            } else {
                $data['orderTasks'] = [];
            }

            $order->tasksChanged = $this->checkOrderTasksChanges($data, $order);

            if ($order->tasksChanged) {
                $order->tasks()->sync($data['orderTasks']);
                $schedule = Schedule::where('order_id', $order->id)->first();
                $schedule_errors = ScheduleService::checkOrderScheduleFit($order);
                $schedule->update([
                    'duration' => $order->duration,
                    'has_error' => $schedule_errors,
                ]);
                $order->update([
                    'price' => $data['orderPrice'],
                    'duration' => $data['orderDuration'],
                ]);
            }

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка обновления работ заказа');
        }
    }

    public function updateOrderNote($data, $order)
    {
        try {
            DB::beginTransaction();

            $orderData = ['note' => $data['note']];
            $order->update($orderData);

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка обновления комментария к заказу');
        }
    }

    public function updateOrderState($data, $order)
    {
        try {
            DB::beginTransaction();

            if (isset($data['state'])) {
                $data['state'] = [
                    [
                        'state_id' => $data['state'],
                        'user_id' => auth()->user()->id,
                    ]
                ];
                $order->states()->attach($data['state']);
            }

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка обновления статуса заказа');
        }
    }

    public function updateOrderPayment($data, $order)
    {
        try {
            DB::beginTransaction();

            $orderData = ['is_paid' => $data['is_paid']];
            $order->update($orderData);

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка обновления оплаты заказа');
        }
    }

    public function storeOrderFeedback($order, $data)
    {
        try {
            DB::beginTransaction();

            $data['order_id'] = $order->id;
            Feedback::firstOrCreate(['order_id' => $order->id], $data);

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка сохранения отзыва клиента');
        }
    }

    public function updateOrderParts($order, $data)
    {
        try {
            DB::beginTransaction();
            $parts = $this->getOrderParts($data);
            $order->parts()->delete();
            if (!empty($parts)) {
                $order->parts()->saveMany($parts);

                $totalPrice = 0;
                foreach ($parts as $part) {
                    $totalPrice += $part->price * $part->quantity;
                }

                foreach ($order->tasks as $task) {
                    $totalPrice += $task->pivot->price * $task->pivot->quantity * ($task->pivot->duration / 60);
                }

                $order->update([
                    'price' => (int)$totalPrice,
                ]);
            }

            DB::commit();

            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка обновления запчастей и материалов заказа');
        }
    }

    private function getOrderParts($data)
    {
        $parts = [];
        if (!empty($data) && isset($data['parts_codes'])) {
            foreach ($data['parts_codes'] as $index => $item) {
                if (isset($data['parts_titles'][$index]) && isset($data['parts_prices'][$index]) && isset($data['parts_qts'][$index])) {
                    $parts[] = new Part([
                        'code' => $data['parts_codes'][$index],
                        'title' => $data['parts_titles'][$index],
                        'price' => $data['parts_prices'][$index],
                        'quantity' => $data['parts_qts'][$index],
                    ]);
                }
            }
        }
        return $parts;
    }

}
