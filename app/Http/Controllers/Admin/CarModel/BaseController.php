<?php

namespace App\Http\Controllers\Admin\CarModel;

use App\Http\Controllers\Controller;
use App\Service\CarDataService;

class BaseController extends Controller
{
    public $service;

    public function __construct(CarDataService $service)
    {
        $this->service = $service;
    }
}
