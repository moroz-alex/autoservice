<?php

namespace App\Http\Controllers\Admin\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['state'] = [
            [
                'state_id' => 2,
                'user_id' => 2, // TODO Заменить на текущего менеджера
            ]
        ];
        $order = OrderService::store($data);
        $request->session()->forget('carId');

        return redirect()->route('admin.schedules.create', compact('order'));
    }
}
