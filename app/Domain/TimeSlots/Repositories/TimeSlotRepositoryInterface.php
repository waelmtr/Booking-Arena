<?php

namespace App\Domain\TimeSlots\Repositories;

use App\Interfaces\Http\Requests\TimeSlotRequest;
use Illuminate\Http\Request;

interface TimeSlotRepositoryInterface {
    public function create(TimeSlotRequest $request);
    public function index(Request $request);
    public function delete($id);
}