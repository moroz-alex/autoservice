<?php

namespace App\Http\Controllers\User\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\StoreRequest;
use App\Models\Settings;
use App\Notifications\NewOrderAdminNotification;
use App\Notifications\NewOrderUserNotification;
use Illuminate\Notifications\Notifiable;

class StoreController extends Controller
{
    use Notifiable;

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $order = OrderService::store($data, 1);
        $settings = Settings::first();
        $settings->notify(new NewOrderAdminNotification($order->id));
        $order->car->user->notify(new NewOrderUserNotification($order->id));

        return redirect()->route('user.schedules.create', compact('order'));
    }
}
