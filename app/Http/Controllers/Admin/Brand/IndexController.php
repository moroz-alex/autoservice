<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Settings;

class IndexController extends Controller
{
    public function __invoke()
    {
        $brands = Brand::paginate(50);
        $settings = Settings::first();
        $lastUpdate = $settings->models_updated_at;
        return view('admin.brands.index', compact('brands', 'lastUpdate'));
    }
}
