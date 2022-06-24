<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $tasks = Task::all()->sortBy('title')->sortBy('category.title');
        return view('admin.tasks.index', compact('tasks'));
    }
}
