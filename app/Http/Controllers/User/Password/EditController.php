<?php

namespace App\Http\Controllers\User\Password;

use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return  view('user.password.edit', compact('user'));
    }
}
