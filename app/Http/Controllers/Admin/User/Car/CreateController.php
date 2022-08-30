<?php

namespace App\Http\Controllers\Admin\User\Car;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\User;
use function view;

class CreateController extends Controller
{
    public function __invoke(User $user)
    {
        if (request()->get('quickOrder')) {
            session(['quickOrder' => true]);
        }
        $models = CarModel::with('brand')->get();
        return  view('admin.users.cars.create', compact('user', 'models'));
    }

}
