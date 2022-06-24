<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\StoreRequest;
use App\Models\Schedule;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        Schedule::create($data);

        return redirect()->route('admin.orders.index');
    }
}
