<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use function view;

class ShowController extends Controller
{
    public function __invoke(User $user, Order $order)
    {
        return view('user.orders.show', compact('user', 'order'));
    }
}
