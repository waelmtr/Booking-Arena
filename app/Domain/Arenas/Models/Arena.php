<?php

namespace App\Domain\Arenas\Models;

use Illuminate\Database\Eloquent\Model;
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

    }
}
