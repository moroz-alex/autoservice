<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class CreateController extends Controller
{
    public function __invoke()
    {
        $userRoles = User::getRoles();
        return  view('admin.users.create', compact('userRoles'));
    }

}
