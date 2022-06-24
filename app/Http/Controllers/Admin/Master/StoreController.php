<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Requests\Admin\Master\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);

        return redirect()->route('admin.masters.index');
    }
}
