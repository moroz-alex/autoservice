<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function __invoke()
    {
        return view('help');
    }
}
