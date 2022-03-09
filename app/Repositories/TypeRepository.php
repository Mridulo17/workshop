<?php


namespace App\Repositories;

use App\Models\Type;
use App\Interfaces\TypeInterface;


class TypeRepository extends BaseRepository implements TypeInterface
{
    public function __construct(Type $model)
    {
        $this->model = $model;
    }
}
