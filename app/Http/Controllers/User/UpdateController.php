<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();
        $data['role'] = 0;
        $user = auth()->user();
        $user->update($data);
        return  redirect()->route('user.show');
    }
}
