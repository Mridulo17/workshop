<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Models\Designation;
use App\Models\Driver;
use App\Models\DriverRecord;
use App\Interfaces\DriverRecordInterface;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;


class DriverRecordRepository extends BaseRepository implements DriverRecordInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
    protected $employee;

    public function __construct(DriverRecord       $model,
                                TypeRepository        $type,
                                CategoryRepository    $category,
                                BrandRepository       $brand,
                                ModelRepository       $product_model,
                                ProductRepository     $product,
                                EmployeeRepository    $employee)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
        $this->employee = $employee;
    }

    public function commonData($driver_record = null)
    {
        $edit = $driver_record == null ? false : true;

        $all_employees = Employee::query()->where('status','Active')->get();
        $employees = Collection::empty();
        $employee_driver = Designation::query()->where('name','LIKE',"%Driver%")->where('status','Active')->first();
        $all_drivers = Employee::query()->where('designation_id',$employee_driver->id)->where('status','Active')->get();
        $drivers = Collection::empty();

        $productIdsToSkip = $this->model->pluck('product_id')->toArray();

        foreach ($all_employees as $employee){
            $employees[$employee->id] = $employee->bn_name.' ['.ENTOBN::convert_to_bangla($employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($employee->new_pin).']';
        }
        foreach ($all_drivers as $driver){
            $drivers[$driver->id] = $driver->bn_name.' ['.ENTOBN::convert_to_bangla($driver->old_pin).']'.' ['.ENTOBN::convert_to_bangla($driver->new_pin).']';
        }

        if ($edit){
            $driver_record['brand_id'] = @$driver_record->product->brand_id;
            $driver_record['model_id'] = @$driver_record->product->model_id;
            $driver_record['type_id'] = @$driver_record->product->type_id;
            $driver_record['category_id'] = @$driver_record->product->category_id;

            $key = array_search($driver_record->product_id, $productIdsToSkip);
            if (array_search($driver_record->product_id, $productIdsToSkip) !== false) {
                unset($productIdsToSkip[$key]);
            }

            foreach ($driver_record->driverRecordDetails as $driverRecordDetail){
                foreach ($driverRecordDetail->getAttributes() as $key => $value){
                    if (substr_count($key,'date') > 0){
                        $driverRecordDetail[$key] = $value ? date('d-m-Y',strtotime($value)) : null;
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
            'driver_record' => $driver_record,
            'product_id' => $edit ? $driver_record->product->id : '',
            'employees' => $employees,
            'drivers' => $drivers,
            'brands' => $this->brand->pluck(),
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$driver_record->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluckForLogReports($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluckForLogReports($selectProductRawParamsWithRegistrationNumber),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$driver_record->product->type_id]) : $this->category->pluck(),
            'entry_types' => DriverRecord::entry_types(),
        ];

        return $data;
    }
}
