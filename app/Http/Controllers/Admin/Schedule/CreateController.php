<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Master;
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

//        $start = date_create('now');
//        $iterations = 0;

        $mastersListAll = Master::all();
        foreach ($mastersListAll as $master) {
//            $iterations++;
            if (empty(array_diff($order->tasks()->pluck('task_id')->toArray(), $master->tasks->pluck('id')->toArray()))) {
                $mastersList[] = $master;
                $mastersListIds[] = $master->id;
//                echo $master->id . '<br>';
            }
        }


        $timeNow = strtotime('now');
        for ($date = $timeNow; $date <= strtotime($endDate); $date = strtotime('+1 day', $date)) {
//            $iterations++;
            if (in_array(date('N', $date), $workDays)) {
                $scheduleStartTime = strtotime(date('Y-m-d', $date) . ' ' . $scheduleStart);
                $scheduleEndTime = strtotime(date('Y-m-d', $date) . ' ' . $scheduleEnd);
                for ($time = $scheduleStartTime; $time < $scheduleEndTime; $time = strtotime('+' . $timeSlotSize . ' minutes', $time)) {
//                    $iterations++;
                    foreach ($mastersList as $master) {
//                        $iterations++;
                        $timeSlots[$time][$master->id] = 'unusable';
                    }
//                    echo date('Y-m-d H:i', $time) . '<br>';
                }
            }
        }

        foreach ($scheduleTasks as $task) {
//            $iterations++;
            $taskStart = strtotime($task->start_time);
            $taskEnd = strtotime('+' . $task->duration . ' minutes', $taskStart);
//            echo date('Y-m-d H:i', $taskStart) . ' ' . date('Y-m-d H:i', $taskEnd) . '<br>';
            if (array_key_exists($taskStart, $timeSlots) && in_array($task->master_id, $mastersListIds)) {
                $timeSlots[$taskStart][$task->master_id] = 'used';
                for ($time = $taskStart; $time < $taskEnd; $time = strtotime('+' . $timeSlotSize . ' minutes', $time)) {
//                    $iterations++;
                    $timeSlots[$time][$task->master_id] = 'used';
                }
            }
        }
//        dd($timeSlots);


        $orderTimeSlotsNumber = $order->duration / $timeSlotSize;

        foreach ($mastersList as $master) {
//            $iterations++;
            $timeSlotsKeys = array_keys($timeSlots);
            $timeSlotsCount = count($timeSlotsKeys);
//            dd($timeSlotsCount);
            $pos = 0;
            $timeSlot = $timeSlotsKeys[$pos];
            while (isset($timeSlots[$timeSlot]) && $pos < $timeSlotsCount) {
//                $iterations++;
                if ($timeSlots[$timeSlot][$master->id] == 'unusable' && $timeSlot > $timeNow) {
                    $count = 0;
                    $time = $timeSlot;
                    while (isset($timeSlots[$time][$master->id]) && $timeSlots[$time][$master->id] == 'unusable') {
//                        $iterations++;
                        $count++;
                        if ($count >= $orderTimeSlotsNumber) {
                            $startTime = strtotime('-' . $order->duration - $timeSlotSize . ' minutes', $time);
                            $timeSlots[$startTime][$master->id] = 'free';
                        }
                        $time = strtotime('+' . $timeSlotSize . ' minutes', $time);
                    }
                    $pos += $count;
                    if ($pos < $timeSlotsCount) {
                        $timeSlot = $timeSlotsKeys[$pos];
                    }
                } else {
                    if (++$pos < $timeSlotsCount) {
                        $timeSlot = $timeSlotsKeys[$pos];
                    }
                }
            }
        }


//        $finish = date_create('now');
//        dump($iterations);
//        $interval = date_diff($finish, $start);
//        dump($interval->format('%s %F'));
        $disableDays = array_diff([1,2,3,4,5,6,7], $workDays);
        foreach ($disableDays as &$disableDay) {
            if ($disableDay == 7) $disableDay = 0;
        }
        $disableDays = implode(',', $disableDays);

        return view('admin.schedules.create', compact('order', 'timeSlots', 'timeSlotsNumber', 'mastersList', 'disableDays'));
    }
}
