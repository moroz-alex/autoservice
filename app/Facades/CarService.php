<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CarService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CarService';
    }
}
