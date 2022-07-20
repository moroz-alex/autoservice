<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Facades\ScheduleService;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $startDate = date('Y-m-d', strtotime('-1 month'));
        $mastersList = ScheduleService::getAllMasters();
        $timeSlots = ScheduleService::getTimeSlots(null, $mastersList, $startDate);
        $timeSlotsNumber = ScheduleService::getTimeSlotsNumber();
        $disableDays = ScheduleService::getDisabledDays();
        return view('admin.schedules.index', compact('timeSlots', 'timeSlotsNumber', 'mastersList', 'disableDays'));
    }
}
