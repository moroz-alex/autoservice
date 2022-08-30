<?php

namespace App\Http\Controllers\User\Car;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use function view;

class CreateController extends Controller
{
    public function __invoke()
    {
        if (request()->get('quickOrder')) {
            session(['quickOrder' => true]);
        }

        $user = auth()->user();
        $models = CarModel::with('brand')->get();
        return  view('user.cars.create', compact('user', 'models'));
    }

}
