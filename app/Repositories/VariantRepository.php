<?php


namespace App\Repositories;

use App\Interfaces\VariantInterface;
use App\Models\Variant;


class VariantRepository extends BaseRepository implements VariantInterface
{
    public function __construct(Variant $variant)
    {
        $this->model = $variant;
    }
}
