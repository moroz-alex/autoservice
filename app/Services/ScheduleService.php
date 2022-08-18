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
        $this->workDays = explode(',', $this->settings->work_days);
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function getTimeSlots($order, $mastersList, $startDate = null, $endDate = null, $startTime = null)
    {
        $startDate = $startDate ?? date('Y-m-d');
        $endDate = $endDate ?? date('Y-m-d', strtotime('+1 month'));

// Вариант "простой"
//        $scheduleTasks = Schedule::where('start_time', '<=', $endDate . ' ' . $this->settings->schedule_end)
//            ->where('start_time', '>=', $startDate . ' ' . $this->settings->schedule_start)
//            ->with('order.states')
//            ->get();
//  -----

// Вариант с лучшей скоростью и меньшим (в 20-25 раз) потреблением памяти  -----
        $scheduleTasks = Schedule::select('schedules.*', 'order_states.state_id as state_id')
            ->leftjoin('order_states', 'schedules.order_id', '=', 'order_states.order_id')
            ->where('order_states.created_at', function ($query) {
                $query->from('order_states')
                    ->whereRaw('`order_states`.`order_id` = `schedules`.`order_id`')
                    ->selectRaw('max(`created_at`)')
                    ->orWhereNull('order_states.state_id');
            })
            ->whereNotIn('order_states.state_id', [4,5])
            ->where('start_time', '>=', $startDate . ' ' . $this->settings->schedule_start)
            ->where('start_time', '<=', $endDate . ' ' . $this->settings->schedule_end)
            ->get();
//  -----

        $timeSlots = $this->createTimeSlots($startDate, $endDate, $mastersList);

        $timeSlots = $this->fillScheduleUsedTimeSlots($timeSlots, $scheduleTasks, $mastersList, $order);

        $timeSlots = $this->getScheduleFreeTimeSlots($timeSlots, $mastersList, $order, $startTime);

        return $timeSlots;
    }

    public function getTimeSlotsNumber()
    {
        return (strtotime($this->settings->schedule_end) - strtotime($this->settings->schedule_start)) / ($this->timeSlotSize * 60);
    }

    public function getMastersList($order)
    {
        $mastersListAll = Master::where('is_available', true)->get();
        $orderTasksIds = $order->tasks()->pluck('task_id')->toArray();
        foreach ($mastersListAll as $master) {
            if (empty(array_diff($orderTasksIds, $master->tasks->pluck('id')->toArray()))) {
                $mastersList[] = $master;
            }
        }
        return $mastersList;
    }

    public function getAllMasters()
    {
        $mastersList = Master::where('is_available', true)->get();
        foreach ($mastersList as $master) {
            $mastersListArray[] = $master;
        }
        return $mastersListArray;
    }

    public function getDisabledDays()
    {
        $disableDays = array_diff([1, 2, 3, 4, 5, 6, 7], $this->workDays);
        foreach ($disableDays as &$disableDay) {
            if ($disableDay == 7) $disableDay = 0;
        }
        return implode(',', $disableDays);
    }

    private function createTimeSlots($startDate, $endDate, $mastersList)
    {
        $endDate = strtotime($endDate);
        $timeSlots = [];
        for ($date = strtotime($startDate); $date <= $endDate; $date = strtotime('+1 day', $date)) {
            if (in_array(date('N', $date), $this->workDays)) {
                $scheduleStartTime = strtotime(date('Y-m-d', $date) . ' ' . $this->settings->schedule_start);
                $scheduleEndTime = strtotime(date('Y-m-d', $date) . ' ' . $this->settings->schedule_end);
                for ($time = $scheduleStartTime; $time < $scheduleEndTime; $time = strtotime('+' . $this->timeSlotSize . ' minutes', $time)) {
                    foreach ($mastersList as $master) {
                        $timeSlots[$time][$master->id] = 'unusable';
                    }
                }
            }
        }
        return $timeSlots;
    }

    private function fillScheduleUsedTimeSlots($timeSlots, $scheduleTasks, $mastersList, $order)
    {
        $orderId = $order->id ?? 0;
        $mastersListIds = array_column($mastersList, 'id');

        foreach ($scheduleTasks as $task) {
// Вариант "простой" -----
//            if (isset($task->order->states->first()->id) && !in_array($task->order->states->first()->id, [4, 5])) {
//  -----

                $taskStart = strtotime($task->start_time);
                $taskEnd = strtotime('+' . $task->duration . ' minutes', $taskStart);
                if (array_key_exists($taskStart, $timeSlots) && in_array($task->master_id, $mastersListIds) && $task->order_id != $orderId) {
                    $timeSlots[$taskStart][$task->master_id] = $task->order_id;
                    for ($time = strtotime('+' . $this->timeSlotSize . ' minutes', $taskStart); $time < $taskEnd; $time = strtotime('+' . $this->timeSlotSize . ' minutes', $time)) {
                        if ($timeSlots[$time][$task->master_id] == 'unusable') {
                            $timeSlots[$time][$task->master_id] = 'used';
                        }
                    }
                }
// Вариант "простой" -----
//            }
//  -----
        }

//        dd(111);
        return $timeSlots;
    }

    private function getScheduleFreeTimeSlots($timeSlots, $mastersList, $order, $startTime = null)
    {
        $orderDuration = $order->duration ?? $this->timeSlotSize;
        $orderTimeSlotsNumber = $orderDuration / $this->timeSlotSize;
        $timeNow = $startTime ? strtotime($startTime) : strtotime('now');
        foreach ($mastersList as $master) {
            $timeSlotsKeys = array_keys($timeSlots);
            $timeSlotsCount = count($timeSlotsKeys);
            $pos = 0;
            $timeSlot = $timeSlotsKeys[$pos];
            while (isset($timeSlots[$timeSlot]) && $pos < $timeSlotsCount) {
                if ($timeSlots[$timeSlot][$master->id] == 'unusable' && $timeSlot >= $timeNow) {
                    $count = 0;
                    $time = $timeSlot;
                    while (isset($timeSlots[$time][$master->id]) && $timeSlots[$time][$master->id] == 'unusable') {
                        $count++;
                        if ($count >= $orderTimeSlotsNumber) {
                            $startTime = strtotime('-' . $orderDuration - $this->timeSlotSize . ' minutes', $time);
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

    public function checkOrderScheduleFit($order, $startTime = null, $master = null)
    {
        if (!isset($order->schedule)) return 0;

        $startTime = $startTime ?? $order->schedule->start_time;
        $orderDate = date('Y-m-d', strtotime($startTime));

        $master = $master ?? $order->schedule->master;
        $mastersList[] = $master;

        $scheduleTasks = Schedule::where('start_time', '<=', $orderDate . ' ' . $this->settings->schedule_end)
            ->where('start_time', '>=', $orderDate . ' ' . $this->settings->schedule_start)
            ->where('master_id', $master->id)
            ->get();

        $timeSlots = $this->createTimeSlots($orderDate, $orderDate, $mastersList);

        $timeSlots = $this->fillScheduleUsedTimeSlots($timeSlots, $scheduleTasks, $mastersList, $order);

        $timeSlots = $this->getScheduleFreeTimeSlots($timeSlots, $mastersList, $order);

        if ($timeSlots[strtotime($startTime)][$master->id] != 'free'
            && isset($order->schedule) && $startTime > date('Y-m-d H:i:s')) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getTimeSlotsForClient($order, $mastersList)
    {
        $startDate = strtotime('now') < strtotime($this->settings->schedule_end) ? date('Y-m-d') : date('Y-m-d', strtotime('+1 day'));
        $timeSlots = $this->getTimeSlots($order, $mastersList, $startDate);
        foreach ($timeSlots as $time => $masters) {
            foreach ($masters as $master => $state) {
                $hasFreeSlot = 0;
                if ($state == 'free') {
                    $timeSlotsForClient[$time] = 'free';
                    $hasFreeSlot = 1;
                    break;
                }
            }
            if (!$hasFreeSlot) {
                $timeSlotsForClient[$time] = 'unusable';
            }
        }
        return $timeSlotsForClient;
    }

    public function distributeOrderAmongMasters($order, $start_time)
    {
        $mastersList = $this->getMastersList($order);
        $start_time = strtotime($start_time);
        $orderDate = date('Y-m-d', $start_time);
        $dayStartTime = $orderDate . ' ' . $this->settings->schedule_start;
        $timeSlots = $this->getTimeSlots($order, $mastersList, $orderDate, $orderDate, $dayStartTime);
        $mastersLoad = [];
        foreach ($timeSlots as $timeSlot) {
            foreach ($timeSlot as $master => $state) {
                if (!isset($mastersLoad[$master])) {
                    $mastersLoad[$master] = 0;
                }
                if ($state == 'used' || is_int($state)) {
                    $mastersLoad[$master] += 1;
                }
            }
        }
        asort($mastersLoad);

        $lessLoadedMasters = [];
        foreach ($mastersLoad as $master => $load) {
            if ($timeSlots[$start_time][$master] != 'free') {
                continue;
            }
            if (!isset($minMasterLoad)) {
                $minMasterLoad = $load;
            }
            if ($load == $minMasterLoad) {
                $lessLoadedMasters[] = $master;
            }
            if ($load > $minMasterLoad) {
                break;
            }
        }

        return ($lessLoadedMasters[rand(0, count($lessLoadedMasters) - 1)]);
    }

    public function update($data, $order)
    {
        $schedule = Schedule::where('order_id', $order->id)->first();
        $master = Master::find($data['master_id']);

        if (isset($schedule)) {
            if ($this->checkOrderScheduleFit($order, $data['start_time'], $master) == 0) {
                $data['has_error'] = false;
            } else {
                $data['has_error'] = true;
            }
            $schedule->update($data);
        } else {
            Schedule::create($data);
        }
    }
}
