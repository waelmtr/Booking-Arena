<?php

namespace App\Console\Commands;

use App\Domain\Bookings\Enums\StatusEnum;
use App\Domain\TimeSlots\Enums\StatusEnum as TimeSlotStatusEnum;
use App\Domain\Bookings\Models\Booking;
use Illuminate\Console\Command;

class ReleaseStaleBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:release-stale-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Release Bookings that not confirmed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $staleBookings = Booking::where('status' , StatusEnum::Pending->value)
        ->whereRaw('TIMESTAMPDIFF(MINUTE, created_at, NOW()) >= 10')
        ->lockForUpdate()
        ->get();
        foreach($staleBookings as $staleBooking){
            $staleBooking->update(['status' => StatusEnum::Canceled->value]);
            $staleBooking->timeSlot()->update(['status' => TimeSlotStatusEnum::Available->value]);
        }
    }
}
