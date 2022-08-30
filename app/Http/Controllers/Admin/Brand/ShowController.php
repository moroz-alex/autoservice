<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;

class ShowController extends Controller
{
    public function __invoke(Brand $brand)
    {
        $this->authorize('view', auth()->user());

        $models = CarModel::where('brand_id',$brand->id)->paginate(50);
        return view('admin.brands.show', compact('models', 'brand'));
    }
}
