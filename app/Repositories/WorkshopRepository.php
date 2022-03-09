<?php


namespace App\Repositories;

use App\Models\Workshop;
use App\Interfaces\WorkshopInterface;


class WorkshopRepository extends BaseRepository implements WorkshopInterface
{
    public function __construct(Workshop $model)
    {
        $this->model = $model;
    }
}
