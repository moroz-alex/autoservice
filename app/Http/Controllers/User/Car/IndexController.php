<?php

namespace App\Http\Controllers\User\Car;

use App\Facades\CarService;
use App\Http\Controllers\Controller;
use App\Models\Car;
use function view;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $cars = Car::where('user_id', $user->id)->paginate(10);
        foreach ($cars as $car) {
            $car->hasOrders = CarService::hasOrders($car);
        }
        return view('user.cars.index', compact( 'user', 'cars'));
    }
}
