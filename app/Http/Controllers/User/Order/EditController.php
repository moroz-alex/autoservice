<?php

namespace App\Http\Controllers\User\Order;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class EditController extends Controller
{
    public function __invoke(User $user, Order $order)
    {
        if (isset($order->states->first()->id) && $order->states->first()->id != 1) {
            return redirect()->route('user.orders.index', $user->id);
        }

        $cars = $user->cars;
        $tasks = OrderService::getOrderSelectedTasks($order);

        return view('user.orders.edit', compact('order', 'cars', 'tasks', 'user'));
    }
}
