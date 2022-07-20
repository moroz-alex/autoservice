<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cars';
    protected $guarded = false;

    protected $with = ['model'];

    public function model() {
        return $this->belongsTo(CarModel::class, 'model_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
