<?php


namespace App\Repositories;

use App\Models\Supplier;
use App\Interfaces\SupplierInterface;


class SupplierRepository extends BaseRepository implements SupplierInterface
{
    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }
}
