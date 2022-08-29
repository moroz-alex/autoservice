<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Task;

class CreateController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $cars = $user->cars;
        $tasks = Task::where('is_available_to_customer', true)->get();

        return  view('user.orders.create', compact('cars', 'tasks', 'user'));
    }

}
