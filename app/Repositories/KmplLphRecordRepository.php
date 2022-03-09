<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Models\Employee;
use App\Models\KmplLphRecord;
use App\Interfaces\KmplLphRecordInterface;
use Illuminate\Database\Eloquent\Collection;


class KmplLphRecordRepository extends BaseRepository implements KmplLphRecordInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
    protected $employee;
    protected $designation;

    public function __construct(KmplLphRecord $model,
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

    public function commonData($kmpl_lph_record = null)
    {
        $edit = $kmpl_lph_record == null ? false : true;

        $all_employees = Employee::query()->where('status','Active')->get();
        $employees = Collection::empty();
        $productIdsToSkip = $this->model->pluck('product_id')->toArray();
        foreach ($all_employees as $employee){
            $employees[$employee->id] = $employee->bn_name.' ['.ENTOBN::convert_to_bangla($employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($employee->new_pin).']';
        }

        if ($edit){
            $kmpl_lph_record['brand_id'] = @$kmpl_lph_record->product->brand_id;
            $kmpl_lph_record['model_id'] = @$kmpl_lph_record->product->model_id;
            $kmpl_lph_record['type_id'] = @$kmpl_lph_record->product->type_id;
            $kmpl_lph_record['category_id'] = @$kmpl_lph_record->product->category_id;

            $key = array_search($kmpl_lph_record->product_id, $productIdsToSkip);
            if (array_search($kmpl_lph_record->product_id, $productIdsToSkip) !== false) {
                unset($productIdsToSkip[$key]);
            }

            foreach ($kmpl_lph_record->kmplLphDetails as $kmplLphDetail){
                foreach ($kmplLphDetail->getAttributes() as $key => $value){
                    if (substr_count($key,'date') > 0){
                        $kmplLphDetail[$key] = $value ? date('d-m-Y',strtotime($value)) : null;
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
            'kmpl_lph_record' => $kmpl_lph_record,
            'product_id' => $edit ? $kmpl_lph_record->product->id : '',
            'employees' => $employees,
            'brands' => $this->brand->pluck(),
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$kmpl_lph_record->product->brand_id]) : $this->product_model->pluck(),
            'products' => $this->product->selectRawPluckForLogReports($selectProductRawParams),
            'product_registration_numbers' => $this->product->selectRawPluckForLogReports($selectProductRawParamsWithRegistrationNumber),
            'designations' => $this->designation->pluck(),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$kmpl_lph_record->product->type_id]) : $this->category->pluck(),
            'entry_types' => KmplLphRecord::entry_types(),
        ];
        return $data;
    }
}
