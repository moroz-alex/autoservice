<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Master;

class ShowController extends BaseController
{
    public function __invoke(Master $master)
    {
        return view('admin.masters.show', compact('master'));
    }
}
