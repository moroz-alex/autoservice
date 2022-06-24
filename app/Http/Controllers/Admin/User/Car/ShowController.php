<?php

namespace App\Http\Controllers\Admin\User\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use function view;

class ShowController extends Controller
{
    public function __invoke(User $user, Car $car)
    {
        return view('admin.users.cars.show', compact('car'));
    }
}
