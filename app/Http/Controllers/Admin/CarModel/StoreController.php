<?php

namespace App\Http\Controllers\Admin\CarModel;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Settings;

class StoreController extends BaseController
{
    public function __invoke()
    {
        $brands = $this->service->importCarData('auto/categories/1/marks');
        foreach ($brands as $brand) {

            $newBrand = Brand::firstOrCreate(
                [
                    'source_id' => $brand->value,
                ],
                [
                    'title' => $brand->name,
                ],
            );

//            $models = $this->service->importCarData('auto/categories/1/marks/' . $brand->value . '/models/');
//            foreach ($models as $model) {
//                CarModel::firstOrCreate(
//                    [
//                        'source_id' => $model->value,
//                    ],
//                    [
//                        'brand_id' => $newBrand->id,
//                        'title' => $model->name,
//                    ],
//                );
//            }
        }

        $settings = Settings::first();
        $data['models_updated_at'] = date('Y-m-d H:i:s');
        $settings->update($data);

        session()->flash('status', 'Обновление моделей завершено');
        return redirect()->route('admin.brands.index');
    }
}
