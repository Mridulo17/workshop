<?php


namespace App\Repositories;

use App\Interfaces\VariantTypeInterface;
use App\Models\VariantType;


class VariantTypeRepository extends BaseRepository implements VariantTypeInterface
{
    public function __construct(VariantType $variant_type)
    {
        $this->model = $variant_type;
        $this->trans = trans('variant_type.variation_type');
    }
}
