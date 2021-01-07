<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface {

    protected $model;

    public function __construct (Model $model) {
        $this->model = $model;
    }

    // public function create(array $input) {
    //     return $this->model->create($input);
    // }

    // public function find(int $id) {
    //     return $this->model->find($id);
    // }
}