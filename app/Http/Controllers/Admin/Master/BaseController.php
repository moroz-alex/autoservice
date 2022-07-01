<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Services\MasterService;

class BaseController extends Controller
{
    public $service;

    public function __construct(MasterService $service)
    {
        $this->service = $service;
    }
}
