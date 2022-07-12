<?php

namespace App\Http\Controllers\Admin\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Order;
use App\Models\Task;

class EditController extends Controller
{
    public function __invoke(Order $order)
    {
        $cars = Car::all();
        $tasks = OrderService::getOrderSelectedTasks($order);
        $timeIntervals = Task::getTimeIntervals();
        return view('admin.orders.edit', compact('order', 'cars', 'tasks', 'timeIntervals'));
    }
}
