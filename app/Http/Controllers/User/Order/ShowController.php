<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use function view;

class ShowController extends Controller
{
    public function __invoke(Order $order)
    {
        $user = auth()->user();

        $totalTasks = 0;
        foreach ($order->tasks as $task) {
            $totalTasks += $task->pivot->price * $task->pivot->quantity * ($task->pivot->duration / 60);
        }

        $totalParts = 0;
        foreach ($order->parts as $part) {
            $totalParts += $part->price * $part->quantity;
        }

        return view('user.orders.show', compact('user', 'order', 'totalTasks', 'totalParts'));
    }
}
