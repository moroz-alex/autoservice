<?php

namespace App\Http\Controllers\Admin\User\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\Car\StoreRequest;
use App\Models\Car;
use App\Models\User;
use function redirect;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['vin'] = strtoupper($data['vin']);

        $car = Car::create($data);  // Уникальность авто не контролируем

        if (session('quickOrder')) {
            $request->session()->forget('quickOrder');
            session(['carId' => $car->id]);
            return redirect()->route('admin.orders.create');
        } else {
            $user = User::find($data['user_id']);
            return redirect()->route('admin.users.cars.index', compact('user'));
        }
    }
}
