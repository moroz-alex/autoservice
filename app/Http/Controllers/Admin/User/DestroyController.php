<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class DestroyController extends Controller
{
    public function __invoke(User $user)
    {
        $userCarIds = $user->cars()->pluck('id')->toArray();
        $orders = Order::whereIn('car_id', $userCarIds)->with('states')->get();

        if($orders->isEmpty() && $user->cars->isEmpty()) {
            $user->delete();
        } else {
            session()->flash('error', 'У данного клиента имеются заказы и/или авто. Удаление клиента невозможно!');
            $roles = User::USER_ROLES;
            return view('admin.users.show', compact('user', 'roles', 'orders'));
        }

        return redirect()->route('admin.users.index');
    }
}
