<?php

namespace App\Infrastructure\Repositories;

use App\Domain\TimeSlots\Models\TimeSlot;
use App\Domain\TimeSlots\Repositories\TimeSlotRepositoryInterface;
use App\Domain\TimeSlots\Services\TimeSlotService;
use App\Interfaces\Http\Requests\TimeSlotRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function index(Request $request){
        $timeSlots = $this->model
        ->when($request->date , function ($query) use ($request) {
            $start = Carbon::parse($request->date)->startOfDay();
            $end = Carbon::parse($request->date)->endOfDay();
            error_log($start);
            error_log($end);
            $query->whereBetween('start_date', [$start, $end]);
        })->get();
        return $timeSlots;  
    }

    public function delete($id){
        $timeSlot = $this->getById($id);
        $timeSlot->delete();
        return $timeSlot;
    }
}