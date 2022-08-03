<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Order;

class CarService
{
    public function hasOrders(Car $car)
    {
        return Order::where('car_id', $car->id)->orderByDesc('id')->get()->isNotEmpty();
    }
}
