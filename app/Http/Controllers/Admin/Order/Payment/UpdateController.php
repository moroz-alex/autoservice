<?php

namespace App\Http\Controllers\Admin\Order\Payment;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\Payment\UpdateRequest;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();

        $order = OrderService::updateOrderPayment($data, $order);

        return redirect()->route('admin.orders.show', $order->id);
    }
}
