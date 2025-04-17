<?php

namespace App\Domain\Bookings\Services;

use App\Domain\TimeSlots\Enums\StatusEnum;
use App\Domain\TimeSlots\Models\TimeSlot;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BookingService {
    public function updateTimeSlot($time_id){
        $timeSlot = TimeSlot::where('id' , $time_id)->lockForUpdate()->first();
        if($timeSlot->status != StatusEnum::Available->value){
            throw new BadRequestException("time slot is not available" , 400);
        }
        $timeSlot->update([
            "status" => StatusEnum::Pending->value
        ]);
        return $timeSlot;
    }
}