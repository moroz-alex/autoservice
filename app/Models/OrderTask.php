<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTask extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'order_tasks';
    protected $guarded = false;
}
