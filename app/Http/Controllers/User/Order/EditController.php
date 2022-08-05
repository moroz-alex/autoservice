<?php

namespace App\Http\Controllers\User\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Task;
use App\Models\User;

class EditController extends Controller
{
    public function __invoke(User $user, Order $order)
    {
        $cars = $user->cars;
        $tasks = OrderService::getOrderSelectedTasks($order);
        $timeIntervals = Task::getTimeIntervals();
        return view('user.orders.edit', compact('order', 'cars', 'tasks', 'timeIntervals', 'user'));
    }
}
