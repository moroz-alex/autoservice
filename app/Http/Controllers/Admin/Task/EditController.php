<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Task $task)
    {
        $this->authorize('view', auth()->user());

        $categories = Category::all();
        $timeIntervals = Task::getTimeIntervals();
        return  view('admin.tasks.edit', compact('task','categories', 'timeIntervals'));
    }
}
