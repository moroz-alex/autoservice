<?php

namespace App\Service;

use App\Models\Master;
use Illuminate\Support\Facades\DB;

class MasterService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['task_ids'])) {
                $taskIds = $data['task_ids'];
                unset($data['task_ids']);
            }

            $master = Master::create($data);
            if (isset($taskIds)) $master->tasks()->attach($taskIds);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка добавления мастера');
        }
    }

    public function update($data, $master)
    {
        try {
            DB::beginTransaction();

            if (isset($data['task_ids'])) {
                $taskIds = $data['task_ids'];
                unset($data['task_ids']);
            } else {
                $taskIds = [];
            }

            $master->update($data);
            $master->tasks()->sync($taskIds);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, 'Ошибка обновления данных мастера');
        }
    }

}
