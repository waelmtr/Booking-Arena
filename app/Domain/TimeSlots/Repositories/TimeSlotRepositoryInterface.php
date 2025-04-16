<?php

namespace App\Domain\TimeSlots\Repositories;

use App\Interfaces\Http\Requests\TimeSlotRequest;

interface TimeSlotRepositoryInterface {
    public function create(TimeSlotRequest $request);
    public function delete($id);
}