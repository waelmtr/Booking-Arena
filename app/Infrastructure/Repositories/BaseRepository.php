<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ItemNotFoundException;

class BaseRepository {
    public function __construct(private Model $model){}
    public function getById($id){
        $model = $this->model->find($id);
        if(!$model) throw new ItemNotFoundException("item $id not found" , 404);
        return $model;
    }
}