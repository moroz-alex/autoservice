<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\UpdateRequest;
use App\Models\Order;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        ScheduleService::update($data, $order);

        return  redirect()->route('admin.orders.index');
    }
}
