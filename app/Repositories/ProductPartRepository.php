<?php


namespace App\Repositories;

use App\Interfaces\ProductPartInterface;
use App\Helpers\MenuHelper;
use App\Models\ProductPart;
use App\Models\ProductType;

class ProductPartRepository extends BaseRepository implements ProductPartInterface
{
    protected $country;
    protected $brand;
    protected $product;
    protected $product_model;
    protected $unit;
    protected $variant_type;
    protected $variant;
    protected $workshop;
    protected $fire_station;
    protected $type;
    protected $category;


    public function __construct(
        ProductPart $model,
        ProductRepository $product,
        CountryRepository $country,
        ModelRepository $product_model,
        BrandRepository $brand,
        UnitRepository $unit,
        VariantTypeRepository $variant_type,
        VariantRepository $variant,
        WorkshopRepository $workshop,
        FireStationRepository $fire_station,
        TypeRepository $type,
        CategoryRepository $category
    )
    {
        $this->model = $model;
        $this->country = $country;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
        $this->unit = $unit;
        $this->variant_type = $variant_type;
        $this->variant = $variant;
        $this->workshop = $workshop;
        $this->fire_station = $fire_station;
        $this->type = $type;
        $this->category = $category;
    }

    public function commonData($product_part = null)
    {
        $data = [
            'countries' => $this->country->pluck(),
            'types' => $this->type->pluck(),
            'categories' => $product_part ? $this->category->pluck(['type_id'=>$product_part->type_id]) : null,
            'brands' => $this->brand->pluck(),
            'models' => $product_part ? $this->product_model->pluck(['brand_id'=>$product_part->brand_id]) : null,
            'parts_models' => $this->product_model->pluck(),
            'products' => $this->product->pluck(),
            'units' => $this->unit->pluck(),
            'variant_types' => $this->variant_type->pluck(),
            'variants' => $this->variant->pluck(),
            'workshops' => $this->workshop->pluck(),
            'fire_stations' => $this->fire_station->pluck(['division_id'=>@$product_part->workshop->division_id]),
        ];
//        dd($data);

        return $data;
    }
}
