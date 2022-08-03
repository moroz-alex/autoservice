<?php

namespace App\Http\Controllers\Admin\CarModel;

use App\Http\Controllers\Controller;
use App\Services\CarService;

class BaseController extends Controller
{
    public $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }
}
