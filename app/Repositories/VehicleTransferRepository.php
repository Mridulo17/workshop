<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\VehicleTransfer;
use App\Interfaces\VehicleTransferInterface;
use Illuminate\Database\Eloquent\Collection;


class VehicleTransferRepository extends BaseRepository implements VehicleTransferInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
    protected $employee;
    protected $designation;
    protected $fire_station;

    public function __construct(VehicleTransfer       $model,
                                TypeRepository        $type,
                                CategoryRepository    $category,
                                BrandRepository       $brand,
                                ModelRepository       $product_model,
                                ProductRepository     $product,
                                EmployeeRepository    $employee,
                                DesignationRepository $designation,
                                FireStationRepository $fire_station)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
        $this->employee = $employee;
        $this->designation = $designation;
        $this->fire_station = $fire_station;
    }

    public function commonData($vehicle_transfer = null)
    {
        $edit = $vehicle_transfer == null ? false : true;

        $all_employees = Employee::query()->where('status','Active')->get();
        $employees = Collection::empty();
        $productIdsToSkip = $this->model->pluck('product_id')->toArray();


        $order_designations = Designation::query()
            ->where('name','LIKE',"%Director%")
            ->orWhere('name','LIKE',"%Principal%")
            ->orWhere('name','LIKE',"%Officer%")
            ->orWhere('name','LIKE',"%Instructor%")
            ->orWhere('name','LIKE',"%Engineer%")
            ->orWhere('name','LIKE',"%Incharge%")
            ->orWhere('name','LIKE',"%INSPECTOR%")
            ->orWhere('name','LIKE',"%Foreman%")
            ->where('status','Active')->pluck('bn_name','id');

        $transfer_designations = Designation::query()
            ->where('name','LIKE',"%Director%")
            ->orWhere('name','LIKE',"%Foreman%")
            ->where('status','Active')->pluck('bn_name','id');

        foreach ($all_employees as $employee){
            $employees[$employee->id] = $employee->bn_name.' ['.ENTOBN::convert_to_bangla($employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($employee->new_pin).']';
        }

        if ($edit) {
            $vehicle_transfer['brand_id'] = @$vehicle_transfer->product->brand_id;
            $vehicle_transfer['model_id'] = @$vehicle_transfer->product->model_id;
            $vehicle_transfer['type_id'] = @$vehicle_transfer->product->type_id;
            $vehicle_transfer['category_id'] = @$vehicle_transfer->product->category_id;

            $key = array_search($vehicle_transfer->product_id, $productIdsToSkip);
            if (array_search($vehicle_transfer->product_id, $productIdsToSkip) !== false) {
                unset($productIdsToSkip[$key]);
            }

            foreach ($vehicle_transfer->vehicleTransferDetails as $vehicleTransferDetail) {
                foreach ($vehicleTransferDetail->getAttributes() as $key => $value) {
                    if (substr_count($key, 'date') > 0) {
                        $vehicleTransferDetail[$key] = $value ? date('d-m-Y', strtotime($value)) : null;
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
            'vehicle_transfer' => $vehicle_transfer,
            'product_id' => $edit ? $vehicle_transfer->product->id : '',
            'brands' => $this->brand->pluck(),
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$vehicle_transfer->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluckForLogReports($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluckForLogReports($selectProductRawParamsWithRegistrationNumber),
            'employees' => $employees,
            'designations' => $order_designations,
            'transfer_designations' => $transfer_designations,
            'fire_stations' => $this->fire_station->pluck(),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$vehicle_transfer->product->type_id]) : $this->category->pluck(),
            'entry_types' => VehicleTransfer::entry_types(),
        ];
        return $data;
    }
}
