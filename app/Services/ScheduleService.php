<?php

namespace App\Services;

use App\Models\Master;
use App\Models\Schedule;
use App\Models\Settings;

class ScheduleService
{
    public $settings, $timeSlotSize;

    public function __construct()
    {
        $this->settings = Settings::first();
        $this->timeSlotSize = Schedule::getTimeSlotSize();
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function getTimeSlots($order, $mastersList)
    {
        $orderTimeSlotsNumber = $order->duration / $this->timeSlotSize;
        $workDays = explode(',', $this->settings->work_days);
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime('+1 month'));
        $scheduleTasks = Schedule::where('start_time', '<=', $endDate)->where('start_time', '>=', $startDate)->get();

        $mastersListIds = array_column($mastersList, 'id');

        $timeNow = strtotime('now');
        $timeSlots = [];
        for ($date = $timeNow; $date <= strtotime($endDate); $date = strtotime('+1 day', $date)) {
            if (in_array(date('N', $date), $workDays)) {
                $scheduleStartTime = strtotime(date('Y-m-d', $date) . ' ' . $this->settings->schedule_start);
                $scheduleEndTime = strtotime(date('Y-m-d', $date) . ' ' . $this->settings->schedule_end);
                for ($time = $scheduleStartTime; $time < $scheduleEndTime; $time = strtotime('+' . $this->timeSlotSize . ' minutes', $time)) {
                    foreach ($mastersList as $master) {
                        $timeSlots[$time][$master->id] = 'unusable';
                    }
                }
            }
        }

        foreach ($scheduleTasks as $task) {
            $taskStart = strtotime($task->start_time);
            $taskEnd = strtotime('+' . $task->duration . ' minutes', $taskStart);
            if (array_key_exists($taskStart, $timeSlots) && in_array($task->master_id, $mastersListIds) && $task->order_id != $order->id) {
                $timeSlots[$taskStart][$task->master_id] = 'used';
                for ($time = $taskStart; $time < $taskEnd; $time = strtotime('+' . $this->timeSlotSize . ' minutes', $time)) {
                    $timeSlots[$time][$task->master_id] = 'used';
                }
            }
        }

        foreach ($mastersList as $master) {
            $timeSlotsKeys = array_keys($timeSlots);
            $timeSlotsCount = count($timeSlotsKeys);
            $pos = 0;
            $timeSlot = $timeSlotsKeys[$pos];
            while (isset($timeSlots[$timeSlot]) && $pos < $timeSlotsCount) {
                if ($timeSlots[$timeSlot][$master->id] == 'unusable' && $timeSlot > $timeNow) {
                    $count = 0;
                    $time = $timeSlot;
                    while (isset($timeSlots[$time][$master->id]) && $timeSlots[$time][$master->id] == 'unusable') {
                        $count++;
                        if ($count >= $orderTimeSlotsNumber) {
                            $startTime = strtotime('-' . $order->duration - $this->timeSlotSize . ' minutes', $time);
                            $timeSlots[$startTime][$master->id] = 'free';
                        }
                        $time = strtotime('+' . $this->timeSlotSize . ' minutes', $time);
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

        return $timeSlots;
    }

    public function getTimeSlotsNumber()
    {
        return (strtotime($this->settings->schedule_end) - strtotime($this->settings->schedule_start)) / ($this->timeSlotSize * 60);
    }

    public function getMastersList($order)
    {
        $mastersListAll = Master::all();
        foreach ($mastersListAll as $master) {
            if (empty(array_diff($order->tasks()->pluck('task_id')->toArray(), $master->tasks->pluck('id')->toArray()))) {
                $mastersList[] = $master;
            }
        }
        return $mastersList;
    }

    public function getDisabledDays()
    {
        $workDays = explode(',', $this->settings->work_days);
        $disableDays = array_diff([1, 2, 3, 4, 5, 6, 7], $workDays);
        foreach ($disableDays as &$disableDay) {
            if ($disableDay == 7) $disableDay = 0;
        }
        return implode(',', $disableDays);
    }

}
