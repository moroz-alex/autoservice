<?php

namespace App\Http\Controllers\User\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\StoreRequest;
use App\Models\User;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, User $user)
    {
        $data = $request->validated();
        $order = OrderService::store($data);

        return redirect()->route('user.schedules.create', compact('user', 'order'));
    }
}
