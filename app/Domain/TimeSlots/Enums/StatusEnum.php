<?php

namespace App\Domain\TimeSlots\Enums;

enum StatusEnum:string {
    case Available = "available";
    case Pending = "pending";
    case Booked = "booked";

    public static function allStatus(): array {
        return array_column(self::cases() , 'value');
    }
}