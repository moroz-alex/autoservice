<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\State;

class ShowController extends Controller
{
    public function __invoke(Order $order)
    {
        $totalTasks = 0;
        foreach ($order->tasks as $task) {
            $totalTasks += $task->pivot->price * $task->pivot->quantity * ($task->pivot->duration / 60);
        }

        $totalParts = 0;
        foreach ($order->parts as $part) {
            $totalParts += $part->price * $part->quantity;
        }

        $states = State::all();

        return view('admin.orders.show', compact('order', 'totalTasks', 'totalParts', 'states'));
    }
}
