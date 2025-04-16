<?php

namespace App\Interfaces\Http\Controllers;

use App\Domain\TimeSlots\Repositories\TimeSlotRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\TimeSlotRequest;

class TimeSlotController extends Controller {
    public function __construct(private TimeSlotRepositoryInterface $timeSlotRepository){}

    public function store(TimeSlotRequest $request){
        $result =  $this->timeSlotRepository->create($request);
        return $this->success($result);
    }

    public function destroy($id){
        $result =  $this->timeSlotRepository->delete($id);
        return $this->success($result);
    }
}