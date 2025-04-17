<?php

namespace App\Domain\Bookings\Models;

use App\Domain\TimeSlots\Models\TimeSlot;
use App\Models\Sport;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'books';
    protected $guarded = [];
    public function timeSlot(){
        return $this->belongsTo(TimeSlot::class);
    }

    public function sport(){
        return $this->belongsTo(Sport::class);
    }
}
