<?php


namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Interfaces\RepairjobCardInterface;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Unit;
use App\Models\InspectionReport;
use App\Models\RepairJobCard;
use Illuminate\Database\Eloquent\Collection;


class RepairJobCardRepository extends BaseRepository implements RepairjobCardInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
    protected $unit;

    public function __construct(
        RepairJobCard $model,
        TypeRepository $type,
        CategoryRepository $category,
        BrandRepository $brand,
        ModelRepository $product_model,
        UnitRepository $unit,
        ProductRepository $product)
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
        $this->unit = $unit;
    }

    public function commonData($repair_job_card = null)
    {

        $all_employees = Employee::query()->where('status','Active')->get();
        $employees = Collection::empty();
        foreach ($all_employees as $employee){
            $employees[$employee->id] = $employee->bn_name.' ['.ENTOBN::convert_to_bangla($employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($employee->new_pin).']';
        }

        $all_units = Unit::query()->where('status','Active')->get();
        $units = Collection::empty();
        foreach ($all_units as $unit){
            $units[$unit->id] = $unit->bn_name;
        }


//        $selectProductRawParams = [
//            'columns' => "id, tracking_no",
//            'pluck' => [
//                'key' => 'tracking_no',
//                'value' => 'id'
//            ],
//        ];
//        $selectProductRawParamsWithRegistrationNumber = [
//            'columns' => "id, registration_number",
//            'pluck' => [
//                'key' => 'registration_number',
//                'value' => 'id'
//            ],
//        ];

        $edit = $repair_job_card == null ? false : true;

        if ($edit){
            $repair_job_card['brand_id'] = @$repair_job_card->product->brand_id;
            $repair_job_card['model_id'] = @$repair_job_card->product->model_id;
            $repair_job_card['type_id'] = @$repair_job_card->product->type_id;
            $repair_job_card['category_id'] = @$repair_job_card->product->category_id;

//            foreach ($repair_job_card->inspectionReport->demands as $demand) {
//                $product_parts = $demand->with('productPart')->get();
//            }
        }

        $data = [
            'repair_job_card' => $repair_job_card,
            'product_id' => $edit ? $repair_job_card->inspectionReport->workshopOrder->product->id : '',
            'brands' => $this->brand->pluck(),
            'employees' => $employees,
            'units' => $units,
            'models' => $edit ? $this->product_model->pluck(['brand_id' => @$repair_job_card->inspectionReport->product->brand_id]) : $this->product_model->pluck(),
            'types' => $this->type->pluck(),
            'categories' => $edit ? $this->category->pluck(['type_id'=>@$repair_job_card->inspectionReport->product->type_id]) : $this->category->pluck(),
            'fuel_types' => RepairJobCard::fuel_types(),
            'inspection_tracking_numbers' => InspectionReport::query()->pluck('tracking_no','id'),
        ];
        return $data;
    }
}
