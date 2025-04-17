<?php

namespace App\Domain\Arenas\Repositories;

use App\Interfaces\Http\Requests\AddSportRequest;
use App\Interfaces\Http\Requests\ArenaRequest;

interface ArenaRepositoryInterface {
    public function create(ArenaRequest $request);
    public function update(ArenaRequest $request , $id);
    public function index() ;
    public function show($id);
    public function delete($id);
    public function addSports(AddSportRequest $request , $id);
}