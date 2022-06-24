<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }
}
