<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository {
    public function __construct(private Model $model){}
    public function getById($id){
        return $this->model->find($id);
    }
}