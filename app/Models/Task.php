<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tasks';
    protected $guarded = false;

    protected $with = ['category'];

    const TIME_INTERVALS = [
        '15 минут' => 15,
        '30 минут' => 30,
        '45 минут' => 45,
        '1 час' => 60,
        '1.5 часа' => 90,
        '2 часа' => 120,
        '3 часа' => 180,
        '4 часа' => 240,
        '5 часов' => 300,
        '6 часов' => 360,
        '7 часов' => 420,
        '8 часов' => 480,
    ];

    public static function getTimeIntervals() {
        return self::TIME_INTERVALS;
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
