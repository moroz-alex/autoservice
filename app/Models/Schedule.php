<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'schedules';
    protected $guarded = false;

    const TIME_SLOT_SIZE = 15;

    public static function getTimeSlotSize() {
        return self::TIME_SLOT_SIZE;
    }

    public function master() {
        return $this->hasOne(Master::class, 'id');
    }
}
