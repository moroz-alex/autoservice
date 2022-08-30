<?php

namespace App\Http\Controllers\User\Order\Feedback;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\Feedback\StoreRequest;
use App\Models\Order;
use App\Models\Settings;
use App\Notifications\NewFeedbackAdminNotification;
use function redirect;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, Order $order)
    {
        $data = $request->validated();
        OrderService::storeOrderFeedback($order, $data);
        $settings = Settings::first();
        $settings->notify(new NewFeedbackAdminNotification($order->id, $data['rating'], $data['review']));

        return redirect()->route('user.orders.show', compact('order'));
    }
}
