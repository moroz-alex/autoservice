<?php

namespace App\Http\Controllers\Admin\Order\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Order;

class EditController extends Controller
{
    public function __invoke(Order $order)
    {
        $cars = Car::all();

        return view('admin.orders.car.edit', compact('order', 'cars'));
    }
}
