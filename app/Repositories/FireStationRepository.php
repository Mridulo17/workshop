<?php


namespace App\Repositories;

use App\Models\FireStation;
use App\Interfaces\FireStationInterface;


class FireStationRepository extends BaseRepository implements FireStationInterface
{
    public function __construct(FireStation $model)
    {
        $this->model = $model;
    }
}
