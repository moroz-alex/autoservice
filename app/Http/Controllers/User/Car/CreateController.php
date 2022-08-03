<?php

namespace App\Http\Controllers\User\Car;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\User;
use function view;

class CreateController extends Controller
{
    public function __invoke(User $user)
    {
        $models = CarModel::with('brand')->get();
        return  view('user.cars.create', compact('user', 'models'));
    }

}
