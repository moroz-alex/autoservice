<?php

namespace App\Http\Controllers\Admin\CarModel;

use App\Jobs\ImportCarBrandsJob;
use App\Models\Settings;

class StoreController extends BaseController
{
    public function __invoke()
    {

        ImportCarBrandsJob::dispatch($this->service);

        $settings = Settings::first();
        $data['models_updated_at'] = date('Y-m-d H:i:s');
        $settings->update($data);
        session()->flash('status', 'Запущено обновление моделей');

        return redirect()->route('admin.brands.index');
    }
}
