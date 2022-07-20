<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'orders';
    protected $guarded = false;

    protected $with = ['tasks', 'car', 'schedule'];

    public function car() {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function tasks() {
        return $this->belongsToMany(Task::class, 'order_tasks', 'order_id', 'task_id')->withPivot('quantity', 'duration', 'price');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function schedule() {
        return $this->hasOne(Schedule::class, 'order_id');
    }
}
