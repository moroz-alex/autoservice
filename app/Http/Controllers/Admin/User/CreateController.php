<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class CreateController extends Controller
{
    public function __invoke()
    {
        $userRoles = User::getRoles();
        if (request()->get('quickOrder')) {
            session(['quickOrder' => true]);
        }
        return  view('admin.users.create', compact('userRoles'));
    }

}
