<?php

namespace App\Http\Controllers\User\Order\Feedback;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\Feedback\StoreRequest;
use App\Models\Order;
use App\Models\User;
use function redirect;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, User $user, Order $order)
    {
        $data = $request->validated();
        OrderService::storeOrderFeedback($order, $data);

        return redirect()->route('user.orders.show', compact('user', 'order'));
    }
}
