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
        if($car->orders->isEmpty()) {
            $car->delete();
        } else {
            session()->flash('error', 'По данному авто имеются заказы. Удаление автомобиля невозможно!');
            return view('admin.users.cars.show', compact('user', 'car'));
        }

        return redirect()->route('admin.users.cars.index', $user->id);
    }
}
