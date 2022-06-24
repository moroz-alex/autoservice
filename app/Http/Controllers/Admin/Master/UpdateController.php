<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Requests\Admin\Master\UpdateRequest;
use App\Models\Master;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Master $master)
    {
        $data = $request->validated();
        $this->service->update($data, $master);

        return  redirect()->route('admin.masters.index');
    }
}
