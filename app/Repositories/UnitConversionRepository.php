<?php


namespace App\Repositories;

use App\Interfaces\UnitConversionInterface;
use App\Models\UnitConversion;


class UnitConversionRepository extends BaseRepository implements UnitConversionInterface
{
    protected $model;
    protected $unit;
    protected $product_part;

    public function __construct(UnitConversion $model, UnitRepository $unit, ProductPartRepository $product_part)
    {
        $this->model = $model;
        $this->unit = $unit;
        $this->product_part = $product_part;
    }

    public function commonData($id = null)
    {
        $data = [
            'units' => $this->unit->pluck(),
            'product_parts' => $this->product_part->pluck(),
        ];
        return $data;
    }
}
