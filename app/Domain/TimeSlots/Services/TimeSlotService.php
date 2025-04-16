<?php

namespace App\Domain\TimeSlots\Services;

use App\Domain\Arenas\Models\Arena;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Exception\BadRequestException; 

class TimeSlotService {
    public function getDuration($request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $startDateOnly = $start_date->toDateString();
        $endDateOnly = $end_date->toDateString();

        $duration = $start_date->diffInMinutes($end_date , false);
        error_log($duration);
        if ($endDateOnly < $startDateOnly || $duration < 0) {
            throw new BadRequestException("end date must be after start date." , 400);
        }

        if($duration%30 != 0){
            throw new BadRequestException("duration between dates must me configured 30 min , 1h , 1.5h etc ..." , 400);
        }
        return $duration;
    }

    public function checkTimeSlot($request){
        $arena = Arena::find($request->arena_id);
        $lastTimeSlot = $arena->timeSlots()->latest()->first(); 
        if($lastTimeSlot){
            $endDate = Carbon::parse($lastTimeSlot->end_date);
            $startDate = Carbon::parse($request->start_date);
            if($startDate->lessThanOrEqualTo($endDate)){
                throw new BadRequestException("this timeSlot has conflict with other one" , 400);
            }
        }
        return $arena;
    }
}