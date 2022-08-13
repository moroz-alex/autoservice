<?php

namespace App\Http\Controllers\Admin\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\IndexRequest;
use App\Models\Order;


class IndexController extends Controller
{

    public function __invoke(IndexRequest $request)
    {
        $dates = $request->validated();
        if (empty($dates)) {
            $dates['date_from'] = date('Y-m-d', strtotime('-1 month'));
            $dates['date_to'] = date('Y-m-d');
        }

        $orders = Order::where('created_at', '>=', $dates['date_from'] . ' 00:00:00')
            ->where('created_at', '<=', $dates['date_to'] . ' 23:59:59')
            ->orderByDesc('id')
            ->with('states')
            ->get();

        return view('admin.orders.index', compact('orders', 'dates'));
    }
}
