<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Interfaces\VehicleMaintenanceOrderInterface;
use App\Models\Employee;
use App\Models\VehicleMaintenanceOrder;
use Illuminate\Database\Eloquent\Collection;


class VehicleMaintenanceOrderRepository extends BaseRepository implements VehicleMaintenanceOrderInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
//    protected $employee;

    public function __construct(VehicleMaintenanceOrder $model,
                                TypeRepository $type,
                                CategoryRepository $category,
                                BrandRepository $brand,
                                ModelRepository $product_model,
                                ProductRepository $product)
//                                EmployeeRepository $employee)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
//        $this->employee = $employee;
    }

    public function commonData($vehicle_maintenance_order = null)
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

        $edit = $vehicle_maintenance_order == null ? false : true;

        if ($edit){

            $vehicle_maintenance_order['brand_id'] = @$vehicle_maintenance_order->product->brand_id;
            $vehicle_maintenance_order['model_id'] = @$vehicle_maintenance_order->product->model_id;
            $vehicle_maintenance_order['type_id'] = @$vehicle_maintenance_order->product->type_id;
            $vehicle_maintenance_order['category_id'] = @$vehicle_maintenance_order->product->category_id;

            foreach ($vehicle_maintenance_order->vehicleMaintenanceDetails as $vehicleMaintenanceDetail){
                foreach ($vehicleMaintenanceDetail->getAttributes() as $key => $value){
                    if (substr_count($key,'date') > 0){
                        $vehicleMaintenanceDetail[$key] = $value ? date('d-m-Y',strtotime($value)) : null;
                    }
                }
            }
        }


        $data = [
            'vehicle_maintenance_order' => $vehicle_maintenance_order,
            'product_id' => $edit ? $vehicle_maintenance_order->product->id : '',
            'brands' => $this->brand->pluck(),
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$vehicle_maintenance_order->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluck($selectProductRawParams),
            'employees' => $employees,
            'product_registration_numbers' => $this->product->selectRawPluck($selectProductRawParamsWithRegistrationNumber),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$vehicle_maintenance_order->product->type_id]) : $this->category->pluck(),
            'entry_types' => VehicleMaintenanceOrder::entry_types(),
        ];
//        dd($data);
        return $data;
    }
}
