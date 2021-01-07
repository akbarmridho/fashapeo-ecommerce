<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface {

    public function create(array $input): Model;

    public function find(int $id): ? Model;
}