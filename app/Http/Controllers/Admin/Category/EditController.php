<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class EditController extends Controller
{
    public function __invoke(Category $category)
    {
        $this->authorize('view', auth()->user());

        return  view('admin.categories.edit', compact('category'));
    }
}
