<?php

namespace App\Http\Controllers\User\Car;

use App\Facades\CarService;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use function redirect;

class DestroyController extends Controller
{
    public function __invoke(User $user, Car $car)
    {
        if (!CarService::hasOrders($car)) {
            $car->delete();
        }
        return redirect()->route('user.cars.index', $user->id);
    }
}
