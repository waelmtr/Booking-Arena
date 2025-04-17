<?php

namespace App\Domain\Arenas\Models;

use App\Domain\Users\Models\User;
use App\Domain\TimeSlots\Models\TimeSlot;
use App\Models\ArenaSport;
use App\Models\Sport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arena extends Model
{
    protected $table = 'arenas';
    protected $fillable = [
        'name' ,
        'description' ,
        'owner_id' ,
        'location' ,
    ];
    protected $casts = [
        'location' => 'array' ,
    ];

    public function timeSlots():HasMany{
        return $this->hasMany(TimeSlot::class);
    }

    public function owner():BelongsTo{
        return $this->belongsTo(User::class , 'owner_id');
    }

    public function sports(){
        return $this->belongsToMany(Sport::class , ArenaSport::class);
    }
}
