<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Interfaces\InspectionTestingInterface;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\InspectionTesting;
use Illuminate\Database\Eloquent\Collection;


class InspectionTestingRepository extends BaseRepository implements InspectionTestingInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
    protected $employee;
    protected $designation;

    public function __construct(InspectionTesting $model,
                                TypeRepository $type,
                                CategoryRepository $category,
                                BrandRepository $brand,
                                ModelRepository $product_model,
                                ProductRepository $product,
                                EmployeeRepository $employee,
                                DesignationRepository $designation)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
        $this->employee = $employee;
        $this->designation = $designation;
    }

    public function commonData($inspection_testing = null)
    {
        $edit = $inspection_testing == null ? false : true;

        $all_employees = Employee::query()->where('status','Active')->get();
        $employees = Collection::empty();
        $productIdsToSkip = $this->model->pluck('product_id')->toArray();
        foreach ($all_employees as $employee){
            $employees[$employee->id] = $employee->bn_name.' ['.ENTOBN::convert_to_bangla($employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($employee->new_pin).']';
        }

        $all_designations = Designation::query()->where('status','Active')->get();
        $designations = Collection::empty();
        foreach ($all_designations as $designation){
            $designations[$designation->id] = $designation->bn_name;
        }

        if ($edit){
            $inspection_testing['brand_id'] = @$inspection_testing->product->brand_id;
            $inspection_testing['model_id'] = @$inspection_testing->product->model_id;
            $inspection_testing['type_id'] = @$inspection_testing->product->type_id;
            $inspection_testing['category_id'] = @$inspection_testing->product->category_id;

            $key = array_search($inspection_testing->product_id, $productIdsToSkip);
            if (array_search($inspection_testing->product_id, $productIdsToSkip) !== false) {
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
            'inspection_testing' => $inspection_testing,
            'product_id' => $edit ? $inspection_testing->product->id : '',
            'brands' => $this->brand->pluck(),
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$inspection_testing->product->brand_id]) : $this->product_model->pluck(),
            'employees' => $employees,
            'designations' => $designations,
            'products' => $this->product->selectRawPluckForLogReports($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluckForLogReports($selectProductRawParamsWithRegistrationNumber),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$inspection_testing->product->type_id]) : $this->category->pluck(),
            'entry_types' => InspectionTesting::entry_types(),
        ];
//        dd($data);
        return $data;
    }
}
