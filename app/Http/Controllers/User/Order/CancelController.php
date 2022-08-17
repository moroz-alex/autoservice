<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class CancelController extends Controller
{
    public function __invoke(User $user, Order $order)
    {
        $state = [
            [
                'state_id' => 4,
                'user_id' => $user->id,
            ]
        ];
        $order->states()->attach($state);

        return redirect()->route('user.orders.show', compact('user', 'order'));
    }
}
