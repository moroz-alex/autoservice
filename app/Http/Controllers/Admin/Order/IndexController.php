<?php

namespace App\Http\Controllers\Admin\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Models\Order;


class IndexController extends Controller
{
    public function __invoke()
    {
        $orders = Order::orderByDesc('id')->paginate(10);
        $orders = OrderService::checkOrdersSchedule($orders);

        return view('admin.orders.index', compact('orders'));
    }
}
