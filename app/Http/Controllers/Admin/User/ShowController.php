<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        $roles = User::USER_ROLES;
        return view('admin.users.show', compact('user', 'roles'));
    }
}
