<?php

namespace App\Http\Controllers\User\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Car\UpdateRequest;
use App\Models\Car;
use App\Models\User;
use function redirect;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user, Car $car)
    {
        $data = $request->validated();
        $data['vin'] = strtoupper($data['vin']);
        $car->update($data);
        return  redirect()->route('user.cars.index', $user->id);
    }
}
