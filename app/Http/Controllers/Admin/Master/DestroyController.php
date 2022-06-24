<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Master;

class DestroyController extends BaseController
{
    public function __invoke(Master $master)
    {
        $master->delete();
        return redirect()->route('admin.masters.index');
    }
}
