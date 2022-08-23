<?php

namespace App\Http\Controllers\Admin\Order\Task;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Task;

class EditController extends Controller
{
    public function __invoke(Order $order)
    {
        $tasks = OrderService::getOrderSelectedTasks($order);
        $timeIntervals = Task::getTimeIntervals();

        return view('admin.orders.tasks.edit', compact('order', 'tasks', 'timeIntervals'));
    }
}
