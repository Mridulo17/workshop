<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Models\Employee;
use App\Models\FilterChangeRecord;
use App\Interfaces\FilterChangeRecordInterface;
use Illuminate\Database\Eloquent\Collection;


class FilterChangeRecordRepository extends BaseRepository implements FilterChangeRecordInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;

    public function __construct(FilterChangeRecord $model, TypeRepository $type, CategoryRepository $category, BrandRepository $brand, ModelRepository $product_model, ProductRepository $product)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
    }

    public function commonData($filter_change_record = null)
    {
        $edit = $filter_change_record == null ? false : true;

        $all_employees = Employee::query()->where('status','Active')->get();
        $employees = Collection::empty();
        $productIdsToSkip = $this->model->pluck('product_id')->toArray();

        foreach ($all_employees as $employee){
            $employees[$employee->id] = $employee->bn_name.' ['.ENTOBN::convert_to_bangla($employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($employee->new_pin).']';
        }

        if ($edit){
            $filter_change_record['brand_id'] = @$filter_change_record->product->brand_id;
            $filter_change_record['model_id'] = @$filter_change_record->product->model_id;
            $filter_change_record['type_id'] = @$filter_change_record->product->type_id;
            $filter_change_record['category_id'] = @$filter_change_record->product->category_id;

            $key = array_search($filter_change_record->product_id, $productIdsToSkip);
            if (array_search($filter_change_record->product_id, $productIdsToSkip) !== false) {
                unset($productIdsToSkip[$key]);
            }

            foreach ($filter_change_record->filterChangeDetails as $filterChangeDetail){
                foreach ($filterChangeDetail->getAttributes() as $key => $value){
                    if (substr_count($key,'date') > 0){
                        $filterChangeDetail[$key] = $value ? date('d-m-Y',strtotime($value)) : null;
                    }
                }
            }
        }

        $selectProductRawParams = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'productIds' => collect($productIdsToSkip)
        ];

        $selectProductRawParamsWithRegistrationNumber = [
            'columns' => "id, registration_number",
            'pluck' => [
                'key' => 'registration_number',
                'value' => 'id'
            ],
            'productIds' => collect($productIdsToSkip)
        ];

        $data = [
            'filter_change_record' => $filter_change_record,
            'product_id' => $edit ? $filter_change_record->product->id : '',
            'brands' => $this->brand->pluck(),
            'employees' => $employees,
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$filter_change_record->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluckForLogReports($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluckForLogReports($selectProductRawParamsWithRegistrationNumber),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$filter_change_record->product->type_id]) : $this->category->pluck(),
            'entry_types' => FilterChangeRecord::entry_types(),
        ];

        return $data;
    }
}
