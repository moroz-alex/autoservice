<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'car_models';
    protected $guarded = false;

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
