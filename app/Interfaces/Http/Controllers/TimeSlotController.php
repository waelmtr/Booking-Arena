<?php

namespace App\Interfaces\Http\Controllers;

use App\Domain\TimeSlots\Repositories\TimeSlotRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\TimeSlotRequest;
use App\Interfaces\Http\Resources\TimeSlotResource;
use Illuminate\Http\Request;

class TimeSlotController extends Controller {
    public function __construct(private TimeSlotRepositoryInterface $timeSlotRepository){}

    public function store(TimeSlotRequest $request){
        $result =  $this->timeSlotRepository->create($request);
        return $this->success(TimeSlotResource::make($result));
    }

    public function index(Request $request){
        $request->validate(['date' => ['date']]);
        $result =  $this->timeSlotRepository->index($request);
        return $this->success(TimeSlotResource::collection($result));
    }

    public function destroy($id){
        $result =  $this->timeSlotRepository->delete($id);
        return $this->success(TimeSlotResource::make($result));
    }
}