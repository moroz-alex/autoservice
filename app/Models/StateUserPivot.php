<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StateUserPivot extends Pivot
{
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
