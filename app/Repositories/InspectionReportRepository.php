<?php

namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Models\Driver;
use App\Interfaces\InspectionReportInterface;
use App\Models\InspectionReport;
use App\Models\ProductPart;
use App\Models\Type;
use App\Models\WorkshopOrder;
use Illuminate\Database\Eloquent\Collection;

class InspectionReportRepository extends BaseRepository implements InspectionReportInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;
    protected $product;
    protected $workshop;
    protected $driver;
    protected $workshop_order;
    protected $product_part;

    public function __construct(
        InspectionReport $model,
        TypeRepository $type,
        CategoryRepository $category,
        BrandRepository $brand,
        ModelRepository $product_model,
        ProductRepository $product,
        WorkshopRepository $workshop,
        DriverRepository $driver,
        FireStationRepository $fire_station,
        ProductPartRepository $product_part,
        WorkshopOrderRepository $workshop_order
    ) {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->product = $product;
        $this->workshop = $workshop;
        $this->driver = $driver;
        $this->fire_station = $fire_station;
        $this->workshop_order = $workshop_order;
        $this->product_part = $product_part;
    }
    public function commonData($inspection_report = null)
    {
        $selectProductRawParamsWhere = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'where' => [
                'model_id' => @$inspection_report->product->model_id,
                'category_id' => @$inspection_report->product->category_id,
            ],

        ];

        // $selectProductRawParams = [
        //     'columns' => "id, tracking_no",
        //     'pluck' => [
        //         'key' => 'tracking_no',
        //         'value' => 'id'
        //     ],
        // ];

        $edit = $inspection_report == null ? false : true;
        if ($edit) {
             $inspection_report['brand_id'] = @$inspection_report->product->brand_id;
             $inspection_report['model_id'] = @$inspection_report->product->model_id;
             $inspection_report['type_id'] = @$inspection_report->product->type_id;
             $inspection_report['category_id'] = @$inspection_report->product->category_id;

//             foreach ($inspection_report->demands as $demand) {
//                 $product_part = $demand->where('inspection_report_id', $inspection_report->id)->with('productPart')->get();
//             }
        }

//        $all_drivers = Driver::all();
//        $drivers = Collection::empty();
//        foreach ($all_drivers as $item) {
//            $drivers[$item->id] = $item->employee->bn_name . ' [' . ENTOBN::convert_to_bangla($item->employee->old_pin) . ']' . ' [' . ENTOBN::convert_to_bangla($item->employee->new_pin) . ']';
//        }

        $data = [
//             'product_part' => @$product_part,
            'inspection_report' => $inspection_report,
            'brands' => $this->brand->pluck(),
            'product_parts' => ProductPart::query()->pluck('tracking_no', 'id'),
            'model_lists' => $this->product_model->pluck(),
            'models' => $inspection_report ? $this->product_model->pluck(['brand_id' => @$inspection_report->product->brand_id]) : [],
            'products' => $inspection_report ? $this->product->selectRawPluck($selectProductRawParamsWhere) : [],
            'workshops' => $this->workshop->pluck(),
            'fire_stations' => $this->fire_station->pluck(['division_id' => @$inspection_report->workshop->division_id]),
//            'drivers' => $drivers,
            'types' => $this->type->pluck(),
            'category_lists' => $this->category->pluck(),
            'categories' => $inspection_report ? $this->category->pluck(['type_id' => @$inspection_report->product->type_id]) : [],
            'fuel_types' => InspectionReport::fuel_types(),
            'workshop_orders' => WorkshopOrder::query()->pluck('tracking_no', 'id'),
        ];
//         dd($data['product_parts']);
        return $data;
    }
}
