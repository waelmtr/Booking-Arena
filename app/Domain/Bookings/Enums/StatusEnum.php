<?php

namespace App\Domain\Bookings\Enums;

enum StatusEnum : string {
    case Pending = "pending";
    case Confirmed = "confirmed";
    case Canceled = "canceled";
    
    public static function allStatus(){
        return array_column(self::cases() , 'value');
    }
}