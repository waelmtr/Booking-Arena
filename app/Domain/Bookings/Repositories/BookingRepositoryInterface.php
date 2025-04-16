<?php

namespace App\Domain\Bookings\Repositories; 

interface BookingRepositoryInterface {
    public function book($request);
}