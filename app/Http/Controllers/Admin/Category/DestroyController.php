<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class DestroyController extends Controller
{
    public function __invoke(Category $category)
    {
        if($category->tasks->isEmpty()) {
            $category->delete();
        } else {
            session()->flash('error', 'В данной категории имеются работы. Удаление категории невозможно!');
            return view('admin.categories.show', compact('category'));
        }

        return redirect()->route('admin.categories.index');
    }
}
