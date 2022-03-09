<?php


namespace App\Repositories;

use App\Models\TyreRecord;
use App\Models\Designation;
use App\Interfaces\TyreRecordInterface;
use App\Models\Employee;

class TyreRecordRepository extends BaseRepository implements TyreRecordInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
    protected $employee;
    protected $country;

    public function __construct(
        TyreRecord $model,
        TypeRepository $type,
        CategoryRepository $category,
        BrandRepository $brand,
        ModelRepository $product_model,
        ProductRepository $product,
        EmployeeRepository $employee,
        CountryRepository $country
    )
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
        $this->employee = $employee;
        $this->country = $country;
    }

    public function commonData($tyre_record = null)
    {
        $edit = $tyre_record == null ? false : true;
        $productIdsToSkip = $this->model->pluck('product_id')->toArray();
        if ($edit) {
            $tyre_record['type_id'] = @$tyre_record->product->type_id;
            $tyre_record['category_id'] = @$tyre_record->product->category_id;
            $tyre_record['brand_id'] = @$tyre_record->product->brand_id;
            $tyre_record['model_id'] = @$tyre_record->product->model_id;

            $key = array_search($tyre_record->product_id, $productIdsToSkip);
            if ($key) {
                unset($productIdsToSkip[$key]);
            }

            foreach ($tyre_record->tyreRecordDetails as $tyreRecord) {
                foreach ($tyreRecord->getAttributes() as $key => $value) {
                    if (substr_count($key, 'date') > 0) {
                        $tyreRecord[$key] = $value ? date('d-m-Y', strtotime($value)) : null;
                    }
                }
            }
        }

        // $selectProductRawParamsWhere = [
        //     'columns' => "id, tracking_no",
        //     'pluck' => [
        //         'key' => 'tracking_no',
        //         'value' => 'id'
        //     ],
        //     'where' => [
        //         'model_id'=> @$tyre_record->product->model_id,
        //         'category_id'=> @$tyre_record->product->category_id,
        //     ],
        // ];
        // $selectProductRawParams = [
        //     'columns' => "id, tracking_no",
        //     'pluck' => [
        //         'key' => 'tracking_no',
        //         'value' => 'id'
        //     ],
        // ];

        // $selectProductRawParamsWhereWithRegistrationNumber = [
        //     'columns' => "id, registration_number",
        //     'pluck' => [
        //         'key' => 'registration_number',
        //         'value' => 'id'
        //     ],
        //     'where' => [
        //         'registration_number'=> @$tyre_record->product->registration_number,
        //     ],
        // ];
        // $selectProductRawParamsWithRegistrationNumber = [
        //     'columns' => "id, registration_number",
        //     'pluck' => [
        //         'key' => 'registration_number',
        //         'value' => 'id'
        //     ],
        // ];

        $selectProductRawParams = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'productIds' => collect($productIdsToSkip),
        ];

        $selectProductRawParamsWithRegistrationNumber = [
            'columns' => "registration_number, id",
            'pluck' => [
                'key' => 'registration_number',
                'value' => 'id'
            ],
            'productIds' => collect($productIdsToSkip),
        ];

        $driver_designation = Designation::query()->where('name', 'Driver')->where('status', 'Active')->first();
        $all_driver_employees = Employee::query()->where('designation_id', $driver_designation->id)->where('status', 'Active')->get();
        $sso_so_designation = Designation::query()->where('name', 'Senior Station Officer')->orWhere('name', 'Station Officer')->where('status', 'Active')->pluck('id')->toArray();
        $all_sso_so_employees = Employee::query()->whereIn('designation_id', $sso_so_designation)->get();
        $data = [
            'product_id' => $edit ? $tyre_record->product->id : '',
            'tyre_record' => $tyre_record,
            'brands' => $this->brand->pluck(),
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$tyre_record->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluckForLogReports($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluckForLogReports($selectProductRawParamsWithRegistrationNumber),
            'countries' => $this->country->all(),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$tyre_record->product->type_id]) : $this->category->pluck(),
            'entry_types' => TyreRecord::entry_types(),
            'driver_employees' => $all_driver_employees,
            'sso_so_employees' => $all_sso_so_employees,
        ];
        return $data;
    }
}
