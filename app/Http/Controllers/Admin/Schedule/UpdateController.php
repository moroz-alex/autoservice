<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\UpdateRequest;
use App\Models\Order;
use App\Models\Schedule;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        $schedule = Schedule::where('order_id', $order->id)->first();
//        dd($schedule);
        if (isset($schedule)) {
            $schedule->update($data);
        } else {
            Schedule::create($data);
        }
        return  redirect()->route('admin.orders.index');
    }
}
