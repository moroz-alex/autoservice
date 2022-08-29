<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\IndexRequest;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $dates = $request->validated();
        if (empty($dates)) {
            $dates['date_from'] = date('Y-m-d', strtotime('now'));
            $dates['date_to'] = date('Y-m-d', strtotime('+2 weeks'));
        }

        $mastersList = ScheduleService::getAllMasters();
        $timeSlots = ScheduleService::getTimeSlots(null, $mastersList, $dates['date_from'], $dates['date_to']);
        $timeSlotsNumber = ScheduleService::getTimeSlotsNumber();
        $disableDays = ScheduleService::getDisabledDays();
        return view('admin.schedules.index', compact('timeSlots', 'timeSlotsNumber', 'mastersList', 'disableDays', 'dates'));
    }
}
