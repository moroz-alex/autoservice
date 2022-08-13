<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;

class ShowController extends Controller
{
    public function __invoke(Order $order)
    {
        $order = Order::with('states')->find($order->id);

        return view('admin.orders.show', compact('order'));
    }
}
