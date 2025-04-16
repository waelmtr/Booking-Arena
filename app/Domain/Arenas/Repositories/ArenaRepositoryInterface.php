<?php

namespace App\Domain\Arenas\Repositories;

interface ArenaRepositoryInterface {
    public function create($request)  {}
    public function update($request) {}
    public function index() {}
    public function show($id) {}
    public function delete($id) {}
}