<?php


namespace App\Repositories;

use App\Interfaces\BrandInterface;
use App\Models\Brand;


class BrandRepository extends BaseRepository implements BrandInterface
{
    public function __construct(Brand $brand)
    {
        $this->model = $brand;
    }
}
