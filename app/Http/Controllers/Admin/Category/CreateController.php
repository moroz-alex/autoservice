<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        $this->authorize('view', auth()->user());

        return  view('admin.categories.create');
    }

}
