<?php

namespace App\Http\Controllers\Admin\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\IndexRequest;

class StoreController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $order = OrderService::store($data);

        return redirect()->route('admin.schedules.create', compact('order'));
    }
}
