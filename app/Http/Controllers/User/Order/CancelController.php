<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Settings;
use App\Notifications\CancelledOrderAdminNotification;
use App\Notifications\CancelledOrderUserNotification;

class CancelController extends Controller
{
    public function __invoke(Order $order)
    {
        $state = [
            [
                'state_id' => 4,
                'user_id' => auth()->user()->id,
            ]
        ];
        $order->states()->attach($state);

        $settings = Settings::first();
        $settings->notify(new CancelledOrderAdminNotification($order->id));
        $order->user->notify(new CancelledOrderUserNotification($order->id));

        return redirect()->route('user.orders.show', compact('order'));
    }
}
