<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\Settings;

class CreateController extends Controller
{
    public function __invoke(Order $order)
    {
        $timeSlotSize = Schedule::getTimeSlotSize();
        $settings = Settings::first();
        $scheduleStart = $settings->schedule_start;
        $scheduleEnd = $settings->schedule_end;
        $timeSlotsNumber = (strtotime($scheduleEnd) - strtotime($scheduleStart)) / ($timeSlotSize * 60);
        $workDays = explode(',', $settings->work_days);
        $endDate = date('Y-m-d', strtotime('+1 month'));
        $scheduleTasks = Schedule::where('start_time', '<=', $endDate)->get();

        for ($date = strtotime('now'); $date <= strtotime($endDate); $date = strtotime('+1 day', $date)) {
            if (in_array(date('N', $date), $workDays)) {
                $scheduleStartTime = strtotime(date('Y-m-d', $date) . ' ' . $scheduleStart);
                $scheduleEndTime = strtotime(date('Y-m-d', $date) . ' ' . $scheduleEnd);
                for ($time = $scheduleStartTime; $time < $scheduleEndTime; $time = strtotime('+' . $timeSlotSize . ' minutes', $time)) {
                    $timeSlots[$time] = 'free';
//                    echo date('Y-m-d H:i', $time) . '<br>';
                }
            }
        }

        foreach ($scheduleTasks as $task) {
            $taskStart = strtotime($task->start_time);
            $taskEnd = strtotime('+' . $task->duration . ' minutes', $taskStart);
//            echo date('Y-m-d H:i', $taskStart) . ' ' . date('Y-m-d H:i', $taskEnd) . '<br>';
            if (array_key_exists($taskStart, $timeSlots)) {
                $timeSlots[$taskStart] = 'used';
                for ($time = $taskStart; $time < $taskEnd; $time = strtotime('+' . $timeSlotSize . ' minutes', $time)) {
                    $timeSlots[$time] = 'used';
                }
            }
        }

        $orderTimeSlotsNumber = $order->duration / $timeSlotSize;

        foreach ($timeSlots as $timeSlot => $state) {
            if ($state == 'free') {
                $count = 1;
                $time = $timeSlot;
                while ($count <= $orderTimeSlotsNumber) {
                    $time = strtotime('+' . $timeSlotSize . ' minutes', $time);
                    if (isset($timeSlots[$time]) && $timeSlots[$time] == 'free') {
                        $count++;
                    } else {
                        break;
                    }
                }
                if ($count < $orderTimeSlotsNumber) {
                    $timeSlots[$timeSlot] = 'unusable';
                }
            }
        }
        dd($timeSlots);

//        foreach ($timeSlots as $time => $state) {
//            echo date('Y-m-d H:i', $time) . ' - ' . $state . '<br>';
//        }
//        dd(111);

        return view('admin.schedules.create', compact('order', 'timeSlots', 'timeSlotsNumber'));
    }
}
