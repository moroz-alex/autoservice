<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $timeIntervals = Task::getTimeIntervals();
        return  view('admin.tasks.create', compact('categories', 'timeIntervals'));
    }

}
