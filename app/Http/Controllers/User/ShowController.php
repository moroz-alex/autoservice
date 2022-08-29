<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        return view('user.show', compact('user'));
    }
}
