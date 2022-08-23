<?php

namespace App\Http\Controllers\Admin\Order\Note;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\Note\UpdateRequest;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        $order = OrderService::updateOrderNote($data, $order);

        return redirect()->route('admin.orders.show', $order->id);
    }
}
