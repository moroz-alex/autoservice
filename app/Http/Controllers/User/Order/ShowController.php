<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use function view;

class ShowController extends Controller
{
    public function __invoke(Order $order)
    {
        $user = auth()->user();
        return view('user.orders.show', compact('user', 'order'));
    }
}
