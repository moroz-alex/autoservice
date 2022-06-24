<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Master;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $masters = Master::all();
        return view('admin.masters.index', compact('masters'));
    }
}
