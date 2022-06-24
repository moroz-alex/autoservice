<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Order;
use App\Models\Task;

class EditController extends Controller
{
    public function __invoke(Order $order)
    {
        $cars = Car::all();
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

        $timeIntervals = Task::getTimeIntervals();
        return view('admin.orders.edit', compact('order', 'cars', 'tasks', 'timeIntervals'));
    }
}
