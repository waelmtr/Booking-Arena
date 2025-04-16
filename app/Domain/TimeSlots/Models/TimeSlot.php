<?php

namespace App\Domain\TimeSlots\Models;

use App\Domain\Arenas\Models\Arena;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeSlot extends Model
{
    protected $table = 'time_slots';
    protected $guarded = [];

    public function arena():BelongsTo {
        return $this->belongsTo(Arena::class);
    }
    
}
