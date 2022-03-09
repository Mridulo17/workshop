<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Interfaces\MonthlyTransitInterface;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\MonthlyTransit;
use Illuminate\Database\Eloquent\Collection;


class MonthlyTransitRepository extends BaseRepository implements MonthlyTransitInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;

    public function __construct(MonthlyTransit $model, TypeRepository $type, CategoryRepository $category, BrandRepository $brand, ModelRepository $product_model, ProductRepository $product)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
    }

    public function commonData($monthly_transit = null)
    {
        $edit = $monthly_transit == null ? false : true;

        $employee_sso = Designation::query()->where('name','LIKE',"%Senior Station Officer%")->where('status','Active')->first();
        $all_sso = Employee::query()->where('designation_id',$employee_sso->id)->where('status','Active')->get();
        $sso = Collection::empty();
        $productIdsToSkip = $this->model->pluck('product_id')->toArray();
        foreach ($all_sso as $employee){
            $sso[$employee->id] = $employee->bn_name;
        }

        if ($edit){
            $monthly_transit['brand_id'] = @$monthly_transit->product->brand_id;
            $monthly_transit['model_id'] = @$monthly_transit->product->model_id;
            $monthly_transit['type_id'] = @$monthly_transit->product->type_id;
            $monthly_transit['category_id'] = @$monthly_transit->product->category_id;

            $key = array_search($monthly_transit->product_id, $productIdsToSkip);
            if (array_search($monthly_transit->product_id, $productIdsToSkip) !== false) {
                unset($productIdsToSkip[$key]);
            }

        }

        $selectProductRawParams = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'productIds' => collect($productIdsToSkip),
        ];

        $selectProductRawParamsWithRegistrationNumber = [
            'columns' => "id, registration_number",
            'pluck' => [
                'key' => 'registration_number',
                'value' => 'id'
            ],
            'productIds' => collect($productIdsToSkip),
        ];

        $data = [
            'monthly_transit' => $monthly_transit,
            'product_id' => $edit ? $monthly_transit->product->id : '',
            'months' => collect($this->model::months()),
            'brands' => $this->brand->pluck(),
            'employees' => $sso,
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$monthly_transit->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluckForLogReports($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluckForLogReports($selectProductRawParamsWithRegistrationNumber),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$monthly_transit->product->type_id]) : $this->category->pluck(),
            'entry_types' => MonthlyTransit::entry_types(),
        ];
        return $data;
    }
}
