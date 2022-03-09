<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Models\Driver;
use App\Models\ProductType;
use App\Models\WorkshopOrder;
use App\Interfaces\WorkshopOrderInterface;
use Illuminate\Database\Eloquent\Collection;


class WorkshopOrderRepository extends BaseRepository implements WorkshopOrderInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
    protected $workshop;
    protected $driver;

    public function __construct(WorkshopOrder $model, TypeRepository $type, CategoryRepository $category, BrandRepository $brand, ModelRepository $product_model, ProductRepository $product, WorkshopRepository $workshop, DriverRepository $driver)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
        $this->workshop = $workshop;
        $this->driver = $driver;
    }

    public function commonData($workshop_order = null)
    {
        $selectProductRawParamsWhere = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'where' => [
                'model_id'=> @$workshop_order->product->model_id,
                'category_id'=> @$workshop_order->product->category_id,
            ],
        ];
        $selectProductRawParams = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
        ];
        $selectProductRawParamsWhereWithRegistrationNumber = [
            'columns' => "id, registration_number",
            'pluck' => [
                'key' => 'registration_number',
                'value' => 'id'
            ],
            'where' => [
                'registration_number'=> @$lubricant_record->product->registration_number,
            ],
        ];
        $selectProductRawParamsWithRegistrationNumber = [
            'columns' => "id, registration_number",
            'pluck' => [
                'key' => 'registration_number',
                'value' => 'id'
            ],
        ];

        $all_drivers = Driver::all();
        $drivers = Collection::empty();
        foreach ($all_drivers as $item){
            $drivers[$item->id] = $item->employee->bn_name.' ['.ENTOBN::convert_to_bangla($item->employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($item->employee->new_pin).']';
        }
        $edit = $workshop_order == null ? false : true;

        $workshop_order['brand_id'] = @$workshop_order->product->brand_id;
        $workshop_order['model_id'] = @$workshop_order->product->model_id;
        $workshop_order['type_id'] = @$workshop_order->product->type_id;
        $workshop_order['category_id'] = @$workshop_order->product->category_id;
        $data = [
            'workshop_order' => $workshop_order,
            'brands' => $this->brand->pluck(),
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$workshop_order->product->brand_id]) : $this->product_model->pluck(),
            'products' => $edit ? $this->product->selectRawPluck($selectProductRawParamsWhere) : $this->product->selectRawPluck($selectProductRawParams),
            'product_registration_numbers' => $edit ? $this->product->selectRawPluck($selectProductRawParamsWhereWithRegistrationNumber) :
                $this->product->selectRawPluck($selectProductRawParamsWithRegistrationNumber),
//            'products' => $workshop_order ? $this->product->selectRawPluck($selectProductRawParamsWhere) : [],
            'workshops' => $this->workshop->pluck(),
            'drivers' => $drivers,
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$workshop_order->product->type_id]) : $this->category->pluck(),
            'fuel_types' => WorkshopOrder::fuel_types(),
        ];
        return $data;
    }

}
