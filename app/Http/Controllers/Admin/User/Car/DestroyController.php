<?php

namespace App\Http\Controllers\Admin\User\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use function redirect;

class DestroyController extends Controller
{
    public function __invoke(User $user, Car $car)
    {
        $car->delete();
        return redirect()->route('users.cars.index', $user->id);
    }
}
