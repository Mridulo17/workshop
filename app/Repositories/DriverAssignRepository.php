<?php


namespace App\Repositories;

use App\Models\DriverAssign;
use App\Interfaces\DriverAssignInterface;


class DriverAssignRepository extends BaseRepository implements DriverAssignInterface
{
    public function __construct(DriverAssign $model)
    {
        $this->model = $model;
    }
}
