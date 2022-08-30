<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DestroyController extends Controller
{
    public function __invoke(Order $order)
    {
        $orderTasks = [];
        $order->tasks()->sync($orderTasks);
        $order->schedule()->delete();
        $order->parts()->delete();
        $order->delete();
        return redirect()->route('admin.orders.index');
    }
}
