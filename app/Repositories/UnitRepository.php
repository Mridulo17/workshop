<?php


namespace App\Repositories;

use App\Models\Unit;
use App\Interfaces\UnitInterface;


class UnitRepository extends BaseRepository implements UnitInterface
{
    public function __construct(Unit $model)
    {
        $this->model = $model;
    }
}
