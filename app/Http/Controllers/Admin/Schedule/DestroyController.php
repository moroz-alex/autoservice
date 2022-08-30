<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule;

class DestroyController extends Controller
{
    public function __invoke(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.orders.index');
    }
}
