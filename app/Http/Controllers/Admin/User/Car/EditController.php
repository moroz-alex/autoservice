<?php

namespace App\Http\Controllers\Admin\User\Car;

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
        return  view('admin.users.cars.edit', compact('car', 'user', 'models'));
    }
}
