<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Models\Employee;
use App\Models\RepairSummary;
use App\Interfaces\RepairSummaryInterface;
use Illuminate\Database\Eloquent\Collection;


class RepairSummaryRepository extends BaseRepository implements RepairSummaryInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;

    public function __construct(RepairSummary $model, TypeRepository $type, CategoryRepository $category, BrandRepository $brand, ModelRepository $product_model, ProductRepository $product)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
    }

    public function commonData($repair_summary = null)
    {
        $edit = $repair_summary == null ? false : true;

        $all_employees = Employee::query()->where('status','Active')->get();
        $employees = Collection::empty();
        foreach ($all_employees as $employee){
            $employees[$employee->id] = $employee->bn_name.' ['.ENTOBN::convert_to_bangla($employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($employee->new_pin).']';
        }
        $selectProductRawParams = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
        ];
        $selectProductRawParamsWithRegistrationNumber = [
            'columns' => "id, registration_number",
            'pluck' => [
                'key' => 'registration_number',
                'value' => 'id'
            ],
        ];

        if ($edit){
            $repair_summary['brand_id'] = @$repair_summary->product->brand_id;
            $repair_summary['model_id'] = @$repair_summary->product->model_id;
            $repair_summary['type_id'] = @$repair_summary->product->type_id;
            $repair_summary['category_id'] = @$repair_summary->product->category_id;

            foreach ($repair_summary->getAttributes() as $key => $value){
                if (substr_count($key,'date') > 0){
                    $repair_summary[$key] = $value ? date('d-m-Y',strtotime($value)) : null;
                }
            }
        }


        $data = [
            'repair_summary' => $repair_summary,
            'product_id' => $edit ? $repair_summary->product->id : '',
            'brands' => $this->brand->pluck(),
            'employees' => $employees,
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$repair_summary->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluck($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluck($selectProductRawParamsWithRegistrationNumber),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$repair_summary->product->type_id]) : $this->category->pluck(),
            'entry_types' => RepairSummary::entry_types(),
        ];

        return $data;
    }
}
