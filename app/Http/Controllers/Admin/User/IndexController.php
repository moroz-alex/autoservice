<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $users = User::all()->sortByDesc('role');
        $roles = User::USER_ROLES;
        return view('admin.users.index', compact('users', 'roles'));
    }
}
