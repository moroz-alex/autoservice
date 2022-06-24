<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;

class EditController extends Controller
{
    public function __invoke()
    {
        $settings = Settings::first();
        $settings->work_days = explode(',', $settings->work_days);
        $days = Settings::getDays();

        return  view('admin.settings.edit', compact('settings', 'days'));
    }
}
