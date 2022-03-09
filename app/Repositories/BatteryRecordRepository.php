<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Interfaces\BatteryRecordInterface;
use App\Models\Employee;
use App\Models\BatteryRecord;
use Illuminate\Database\Eloquent\Collection;


class BatteryRecordRepository extends BaseRepository implements BatteryRecordInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;

    public function __construct(
        BatteryRecord $model,
        TypeRepository $type,
        CategoryRepository $category,
        BrandRepository $brand,
        ModelRepository $product_model,
        ProductRepository $product)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
    }

    public function commonData($battery_record = null)
    {
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

        $edit = $battery_record == null ? false : true;

        if ($edit){
            $battery_record['brand_id'] = @$battery_record->product->brand_id;
            $battery_record['model_id'] = @$battery_record->product->model_id;
            $battery_record['type_id'] = @$battery_record->product->type_id;
            $battery_record['category_id'] = @$battery_record->product->category_id;

            foreach ($battery_record->batteryDetails as $batteryDetail){
                foreach ($batteryDetail->getAttributes() as $key => $value){
                    if (substr_count($key,'date') > 0){
                        $batteryDetail[$key] = $value ? date('d-m-Y',strtotime($value)) : null;
                    }
                }
            }
        }

        $data = [
            'battery_record' => $battery_record,
            'product_id' => $edit ? $battery_record->product->id : '',
            'brands' => $this->brand->pluck(),
            'employees' => $employees,
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$battery_record->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluck($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluck($selectProductRawParamsWithRegistrationNumber),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$battery_record->product->type_id]) : $this->category->pluck(),
            'entry_types' => BatteryRecord::entry_types(),
        ];

        return $data;
    }
}
