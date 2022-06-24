<?php

namespace App\Http\Controllers\Admin\User\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use function view;

class IndexController extends Controller
{
    public function __invoke(User $user)
    {
        $cars = Car::where('user_id', $user->id)->get();

        return view('admin.users.cars.index', compact( 'user', 'cars'));
    }
}
