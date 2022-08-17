<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Master;
use App\Models\Schedule;

class DestroyController extends BaseController
{
    public function __invoke(Master $master)
    {
        $orders = Schedule::where('master_id', $master->id)->get();

        if($orders->isEmpty()) {
            $master->delete();
        } else {
            session()->flash('error', 'У данного мастера имеются заказы. Удаление мастера невозможно!');
            return view('admin.masters.show', compact('master'));
        }

        return redirect()->route('admin.masters.index');
    }
}
