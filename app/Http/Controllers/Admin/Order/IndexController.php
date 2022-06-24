<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\Eloquent;


class IndexController extends Controller
{
    public function __invoke()
    {
        $orders = Order::orderByDesc('id')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
}
