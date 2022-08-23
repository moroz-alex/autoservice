<?php

namespace App\Http\Controllers\Admin\Order\Part;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\Part\UpdateRequest;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        OrderService::updateOrderParts($order, $data);

        return redirect()->route('admin.orders.show', $order->id);
    }
}
