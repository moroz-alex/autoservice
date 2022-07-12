<?php

namespace App\Http\Controllers\Admin\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        $order = OrderService::update($data, $order);


        return redirect()->route('admin.schedules.edit', compact('order'));
    }
}
