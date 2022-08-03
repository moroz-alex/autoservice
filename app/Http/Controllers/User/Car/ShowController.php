<?php

namespace App\Http\Controllers\User\Car;

use App\Facades\CarService;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Order;
use App\Models\User;
use function view;

class ShowController extends Controller
{
    public function __invoke(User $user, Car $car)
    {
        $hasOrders = CarService::hasOrders($car);
        return view('user.cars.show', compact('user','car', 'hasOrders'));
    }
}
