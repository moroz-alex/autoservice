<?php

namespace App\Http\Controllers\Admin\User;

use App\Facades\OrderService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        $roles = User::USER_ROLES;
        $userCarIds = $user->cars()->pluck('id')->toArray();
        $orders = Order::whereIn('car_id', $userCarIds)->orderByDesc('id')->paginate(10);
        $orders = OrderService::checkOrdersSchedule($orders);

        return view('admin.users.show', compact('user', 'roles', 'orders'));
    }
}
