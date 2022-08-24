<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Settings;

class PrintController extends Controller
{
    public function __invoke(Order $order)
    {
        $settings = Settings::first();
        $companyName = $settings['company_name'];
        $address = $settings['address'];
        $phones = $settings['phones'];
        $totalTasks = 0;
        foreach ($order->tasks as $task) {
            $totalTasks += $task->pivot->price * $task->pivot->quantity * ($task->pivot->duration / 60);
        }

        $totalParts = 0;
        foreach ($order->parts as $part) {
            $totalParts += $part->price * $part->quantity;
        }

        return view('admin.orders.print', compact('order', 'totalTasks', 'totalParts', 'companyName', 'address', 'phones'));
    }
}
