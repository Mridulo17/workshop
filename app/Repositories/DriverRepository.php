<?php


namespace App\Repositories;

use App\Models\Driver;
use App\Interfaces\DriverInterface;


class DriverRepository extends BaseRepository implements DriverInterface
{
    public function __construct(Driver $model)
    {
        $this->model = $model;
    }
}
