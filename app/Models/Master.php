<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'masters';
    protected $guarded = false;

    public function tasks() {
        return $this->belongsToMany(Task::class, 'master_tasks', 'master_id', 'task_id');
    }
}
