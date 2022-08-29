<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        if (!isset(auth()->user()->id)) {
            return view('index');
        }

        if (auth()->user()->role == 1 || auth()->user()->role == 2) {
            return redirect()->route('admin.orders.index');
        } else {
            return redirect()->route('user.orders.index');
        }

    }
}
