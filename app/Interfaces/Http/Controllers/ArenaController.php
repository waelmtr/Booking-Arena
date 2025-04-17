<?php

namespace App\Interfaces\Http\Controllers;

use App\Domain\Arenas\Repositories\ArenaRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\AddSportRequest;
use App\Interfaces\Http\Requests\ArenaRequest;

class ArenaController extends Controller
{
   public function __construct(private ArenaRepositoryInterface $arenaRepository)
   {
   }

   public function store(ArenaRequest $request)
   {
      $result = $this->arenaRepository->create($request);
      return $this->success($result);
   }
   public function update(ArenaRequest $request, $id)
   {
      $result = $this->arenaRepository->update($request, $id);
      return $this->success($result);
   }
   public function index()
   {
      $result = $this->arenaRepository->index();
      return $this->success($result);
   }
   public function show($id)
   {
      $result = $this->arenaRepository->show($id);
      return $this->success($result);
   }
   public function destroy($id)
   {
      $result = $this->arenaRepository->delete($id);
      return $this->success($result);
   }

   public function addSports(AddSportRequest $request , $id){
      $result = $this->arenaRepository->addSports($request , $id);
      return $this->success($result);
   }
}