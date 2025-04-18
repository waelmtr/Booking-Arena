<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Bookings\Enums\StatusEnum;
use App\Domain\TimeSlots\Enums\StatusEnum as TimeSlotStatusEnum;
use App\Domain\Bookings\Repositories\BookingRepositoryInterface;
use App\Domain\Bookings\Services\BookingService;
use App\Interfaces\Http\Requests\BookingRequest;
use App\Domain\Bookings\Models\Booking;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface{
    public function __construct(private Booking $model , private BookingService $bookingService){
        parent::__construct($this->model);
    }

    public function book(BookingRequest $request){
        $timeSlot = $this->bookingService->updateTimeSlot($request->time_slot_id);
        $booking = $this->model->create($request->validated() + ['expire_at' => $timeSlot->end_date , 'status' => StatusEnum::Pending->value , 'user_id' => auth()->id()]);
        return $booking->load('timeSlot' , 'sport');
    }

    public function changeStatus(Request $request , $id){
        $booking = $this->model->find($id);
        if($booking->status != StatusEnum::Pending->value){
            throw new BadRequestException("status is not pending, can not change it" , 400);
        }
        $booking->update(['status' => $request->status]);
        $request->status == StatusEnum::Confirmed->value ?
        $booking->timeSlot()->update(['status' => TimeSlotStatusEnum::Booked->value]):
        $booking->timeSlot()->update(['status' => TimeSlotStatusEnum::Available->value]);
        return $booking->load('timeSlot' , 'sport' , 'user');
    }

    public function allBookings(){
        $bookings = $this->model->with(['timeSlot.arena' , 'sport' , 'user'])->get();
        return $bookings;
    }
}