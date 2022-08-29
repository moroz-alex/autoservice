<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Master;
use App\Models\Task;

class EditController extends BaseController
{
    public function __invoke(Master $master)
    {
        $this->authorize('view', auth()->user());

        $tasks = Task::all();
        return  view('admin.masters.edit', compact('master', 'tasks'));
    }
}
