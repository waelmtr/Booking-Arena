<?php

namespace App\Interfaces\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArenaResource extends JsonResource
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
            "name" => $this->name ,
            "description" => $this->description ,
            "location" => [
                "lon" => $this->location ? (float) $this->location['lon'] : null ,
                "lat" => $this->location ? (float) $this->location['lat'] : null ,
            ] ,
            "timeSlots" => $this->whenLoaded('timeSlots' , fn () => TimeSlotResource::collection($this->timeSlots)) ,
            "sports" => $this->whenLoaded('sports' , fn () => SportResource::collection($this->sports)) ,
        ];
    }
}
