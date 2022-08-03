<?php

namespace App\Http\Controllers\User\Car;

use App\Facades\CarService;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\User;
use function view;

class EditController extends Controller
{
    public function __invoke(User $user, Car $car)
    {
        $models = CarModel::with('brand')->get();
        $hasOrders = CarService::hasOrders($car);

        return  view('user.cars.edit', compact('car', 'user', 'models', 'hasOrders'));
    }
}
