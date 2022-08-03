<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use function view;

class IndexController extends Controller
{
    public function __invoke(User $user)
    {
        $userCarIds = $user->cars()->pluck('id')->toArray();
        $orders = Order::whereIn('car_id', $userCarIds)->orderByDesc('id')->paginate(10);

        return view('user.orders.index', compact( 'user', 'orders'));
    }
}
