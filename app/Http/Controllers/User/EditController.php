<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return  view('user.edit', compact('user'));
    }
}
