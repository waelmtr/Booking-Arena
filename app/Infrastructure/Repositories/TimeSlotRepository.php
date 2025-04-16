<?php

namespace App\Infrastructure\Repositories;

use App\Domain\TimeSlots\Models\TimeSlot;
use App\Domain\TimeSlots\Repositories\TimeSlotRepositoryInterface;
use App\Domain\TimeSlots\Services\TimeSlotService;
use App\Interfaces\Http\Requests\TimeSlotRequest;

class TimeSlotRepository extends BaseRepository implements TimeSlotRepositoryInterface {
    public function __construct(private TimeSlot $model , private TimeSlotService $timeSlotService){
        parent::__construct($this->model);
    }

    public function create(TimeSlotRequest $request){
        $duration = $this->timeSlotService->getDuration($request);
        $arena = $this->timeSlotService->checkTimeSlot($request);
        $timeSlot = $arena->timeSlots()->create($request->validated() + ['duration' => $duration]);
        return $timeSlot->load('arena');
    }
    public function delete($id){
        $timeSlot = $this->getById($id);
        $timeSlot->delete();
        return $timeSlot;
    }
}