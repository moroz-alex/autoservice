<?php

namespace App\Http\Controllers\User\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Car\StoreRequest;
use App\Models\Car;
use function redirect;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['vin'] = strtoupper($data['vin']);
        Car::create($data);  // Уникальность авто не контролируем
        return redirect()->route('user.cars.index');
    }
}
