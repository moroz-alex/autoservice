<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Task;

class CreateController extends Controller
{
    public function __invoke()
    {
        if (request()->get('carId')) {
            $carId = request()->get('carId');
        } else {
            $carId = session('carId');
        }
        session()->forget('carId');

        $cars = Car::all();
        $tasks = Task::all();
        $timeIntervals = Task::getTimeIntervals();
        return view('admin.orders.create', compact('cars', 'tasks', 'timeIntervals', 'carId'));
    }

}
