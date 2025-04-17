<?php

namespace App\Domain\Bookings\Repositories;

use App\Interfaces\Http\Requests\BookingRequest;
use Illuminate\Http\Request; 

interface BookingRepositoryInterface {
    public function book(BookingRequest $request);
    public function changeStatus(Request $request , $id);

    public function allBookings();
}