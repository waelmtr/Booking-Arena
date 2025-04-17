<?php

namespace App\Interfaces\Http\Controllers;

use App\Domain\Bookings\Enums\StatusEnum;
use App\Domain\Bookings\Repositories\BookingRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends Controller {
    public function __construct(private BookingRepositoryInterface $bookingRepository){}

    public function book(BookingRequest $request){
        $result = $this->bookingRepository->book($request);
        return $this->success($result);
    }

    public function allBookings(){
        $result = $this->bookingRepository->allBookings();
        return $this->success($result);
    }

    public function changeStatus(Request $request , $id){
        $request->validate(['status' => [Rule::in([StatusEnum::Confirmed->value , StatusEnum::Canceled->value])]]);
        $result = $this->bookingRepository->changeStatus($request , $id);
        return $this->success($result);
    }
}