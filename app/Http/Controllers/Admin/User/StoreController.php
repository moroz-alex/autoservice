<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use App\Notifications\GeneratedPasswordUserNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        if (isset($data['email'])) {
            $password = Str::random(10);
            $data['password'] = Hash::make($password);
        }

        $user = User::create($data);
        if (isset($user->email)) {
            $user->notify(new GeneratedPasswordUserNotification($user->email, $password));
        }

        return redirect()->route('admin.users.cars.create', compact('user'));
    }
}
