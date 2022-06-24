<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Task;

class CreateController extends BaseController
{
    public function __invoke()
    {
        $tasks = Task::all();
        return  view('admin.masters.create', compact('tasks'));
    }

}
