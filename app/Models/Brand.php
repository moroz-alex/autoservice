<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'brands';
    protected $guarded = false;

    protected $withCount = ['models'];

    public function models() {
        return $this->hasMany(CarModel::class, 'brand_id', 'id');
    }
}
