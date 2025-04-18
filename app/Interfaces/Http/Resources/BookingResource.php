<?php

namespace App\Interfaces\Http\Resources;

use App\Domain\Bookings\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id ,
            "expire_at" => $this->expire_at ,
            "status" => $this->status ?? StatusEnum::Pending->value , 
            "user" => $this->whenLoaded('user' , fn () => UserResource::make($this->user)) ,
            "timeSlot" => $this->whenLoaded('timeSlot' , fn () => TimeSlotResource::make($this->timeSlot)) ,
            "sport" => $this->whenLoaded('sport' , fn () => SportResource::make($this->sport)) ,
        ];
    }
}
