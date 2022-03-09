<?php


namespace App\Repositories;

use App\Interfaces\ModelInterface;
use App\Models\Model;


class ModelRepository extends BaseRepository implements ModelInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
