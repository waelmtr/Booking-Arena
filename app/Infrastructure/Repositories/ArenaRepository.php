<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Arenas\Models\Arena;
use App\Domain\Arenas\Repositories\ArenaRepositoryInterface;
use App\Interfaces\Http\Requests\AddSportRequest;
use App\Interfaces\Http\Requests\ArenaRequest; 

class ArenaRepository extends BaseRepository implements ArenaRepositoryInterface {
    public function __construct(private Arena $model){
        parent::__construct($this->model);
    }

    public function create(ArenaRequest $request){
        $arena = $this->model->create($request->validated() + ['owner_id' => auth()->id()]);
        return $arena;
    }

    public function update(ArenaRequest $request , $id){
        $arena = $this->getById($id);
        $arena->update($request->validated());
        return $arena->load('timeSlots');
    }

    public function show($id){
        $arena = $this->getById($id);
        return $arena->load('timeSlots');
    }

    public function index(){
        $arenas = $this->model->with('timeSlots' , 'sports')->get();
        return $arenas;
    }

    public function delete($id){
        $arena = $this->getById($id);
        $arena->delete();
        return $arena;
    }

    public function addSports(AddSportRequest $request , $id){
        $arena = $this->getById($id);
        $arena->sports()->sync([$request->sports]);
        return $arena->load('sports');
    }
}