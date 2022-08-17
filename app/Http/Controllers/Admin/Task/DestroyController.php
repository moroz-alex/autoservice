<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;

class DestroyController extends Controller
{
    public function __invoke(Task $task)
    {
        if($task->orders->isEmpty()) {
            $task->delete();
        } else {
            session()->flash('error', 'Имеются заказы с данной работой. Удаление работы невозможно!');
            return view('admin.tasks.show', compact('task'));
        }
        return redirect()->route('admin.tasks.index');
    }
}
