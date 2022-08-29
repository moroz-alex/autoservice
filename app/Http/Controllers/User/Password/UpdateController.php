<?php

namespace App\Http\Controllers\User\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Password\UpdateRequest;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return  redirect()->route('user.show');
    }
}
