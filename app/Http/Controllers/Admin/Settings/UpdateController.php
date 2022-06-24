<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\UpdateRequest;
use App\Models\Settings;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();
        $settings = Settings::first();
        $data['work_days'] = implode(',', $data['work_days']);

        $settings->update($data);
        session()->flash('status', 'Настройки обновлены');
        return  redirect()->route('admin.settings.edit');
    }
}
