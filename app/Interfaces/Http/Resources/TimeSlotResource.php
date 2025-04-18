<?php

namespace App\Interfaces\Http\Resources;

use App\Domain\TimeSlots\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeSlotResource extends JsonResource
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
            "start_date" => $this->start_date ,
            "end_date" => $this->end_date ,
            "duration" => $this->duration ,
            "price" => (double) $this->price ,
            "status" => $this->status ?? StatusEnum::Available->value ,
            "arena" => $this->whenLoaded('arena' , fn () => ArenaResource::make($this->arena)) ,
        ];
    }
}
