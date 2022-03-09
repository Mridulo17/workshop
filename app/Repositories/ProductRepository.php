<?php


namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Helpers\MenuHelper;
use App\Models\FireStation;
use App\Models\ProductType;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductInterface
{
    protected $type;
    protected $category;
    protected $country;
    protected $brand;
    protected $product_model;
    protected $workshop;
    protected $fire_station;

    public function __construct(
        Product $model,
        TypeRepository $type,
        CategoryRepository $category,
        CountryRepository $country,
        BrandRepository $brand,
        ModelRepository $product_model,
        WorkshopRepository $workshop,
        FireStationRepository $fire_station
    )
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->country = $country;
        $this->brand = $brand;
        $this->product_model = $product_model;
        $this->workshop = $workshop;
        $this->fire_station = $fire_station;
    }

    public function commonData($product = null)
    {
        $data = [
            'types' => $this->type->pluck(),
            'categories' => $this->category->pluck(['type_id'=>@$product->type_id]),
            'countries' => $this->country->pluck(),
            'brands' => $this->brand->pluck(),
            'workshops' => $this->workshop->pluck(),
            'fire_stations' => $this->fire_station->pluck(['division_id'=>@$product->workshop->division_id]),
        ];
        return $data;
    }

    public function datatable(array $relations = null, $make_true = null,$products_filter=null){
        $products = $relations? Product::with($relations) : Product::query();
        if(!empty($products_filter)){
            $fields = [];
            foreach ($products_filter as $key=>$item){
                if(explode('_',$key)[0] == 'form'){
                    array_push($fields,[explode('_',$key,2)[1]=>$item]);
                }
            }

                $fields = array_merge(...$fields);
                $map_ws = $fields['map_workshop_id'];
                $ws = $fields['workshop_id'];
                $div = $fields['division_id'];
                $dis = $fields['district_id'];
                $tha = $fields['thana_id'];
                $fs = $fields['fire_station_id'];
                $type = $fields['type_id'];
                $status = $fields['status'];
//                dd($ws);
                if ($div && $dis && $tha && $fs ){
                    $products->where('fire_station_id', $fs);
                }
                elseif ($div && $dis && $tha){
                    $fs_ids = FireStation::where('thana_id',$tha)->pluck('id');
                    $products->whereIn('fire_station_id', $fs_ids);
                }
                elseif ($div && $dis){
                    $dis_ids = FireStation::where('district_id',$dis)->pluck('id');
                    $products->whereIn('fire_station_id', $dis_ids);
                }
                elseif ($ws){
                    $products->where('workshop_id', ($map_ws != $ws) ? $ws : $map_ws);
                }
                elseif ($map_ws){
                    $products->where('workshop_id', $map_ws);
                }
                elseif ($div){
                    $div_ids = FireStation::where('division_id',$div)->pluck('id');
                    $products->whereIn('fire_station_id', $div_ids);
                }
                elseif ($dis){
                    $dis_ids = FireStation::where('district_id',$dis)->pluck('id');
                    $products->whereIn('fire_station_id', $dis_ids);
                }
                elseif ($tha){
                    $fs_ids = FireStation::where('thana_id',$tha)->pluck('id');
                    $products->whereIn('fire_station_id', $fs_ids);
                }
                elseif ($fs){
                    $products->where('fire_station_id', $fs);
                }

                if ($type){
                    $products->where('type_id', $type);
                }

                if ($status){
                    $products->where('status', $status);
                }
        }

        $datatable = \Datatables::of($products)
            ->addIndexColumn()
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status','LIKE', "%{$keyword}%");
            })
            ->addColumn('action', function($data){
                $action_array = [
                    'id' => $data->id,
                ];
                $action = '';
                $action .= MenuHelper::TableActionButton($action_array);
                return $action;
            })
            ->addColumn('status', function($data){
                $status = '';
                if($data->status == 'Active'){
                    $status .= '<span class="badge badge-soft-success font-size-11 fw-bold">Active</span>';
                }elseif ($data->status == 'Inactive'){
                    $status .= '<span class="badge badge-soft-pink font-size-11 fw-bold">Inactive</span>';
                }
                return $status;
            })
            ->rawColumns(['action','status']);

        if($make_true != null){
            return $datatable;
        }else{
            return $datatable->make(true);
        }
    }

    public function vehiclesDatatable(array $relations = null, $make_true = null){
        $datatable = \Datatables::of($relations ? $this->model->where('type_id', 1)->with($relations) :
            $this->query())
            ->addIndexColumn()
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status','LIKE', "%{$keyword}%");
            })
            ->addColumn('action', function($data){
                $action_array = [
                    'id' => $data->id,
                ];
                $action = '';
                $action .= MenuHelper::TableActionButton($action_array);
                return $action;
            })
            ->addColumn('status', function($data){
                $status = '';
                if($data->status == 'Active'){
                    $status .= '<span class="badge badge-soft-success font-size-11 fw-bold">Active</span>';
                }elseif ($data->status == 'Inactive'){
                    $status .= '<span class="badge badge-soft-pink font-size-11 fw-bold">Inactive</span>';
                }
                return $status;
            })
            ->rawColumns(['action','status']);

        if($make_true != null){
            return $datatable;
        }else{
            return $datatable->make(true);
        }
    }
    public function pumpsDatatable(array $relations = null, $make_true = null){
        $datatable = \Datatables::of($relations ? $this->model->where('type_id', 2)->with($relations) :
            $this->query())
            ->addIndexColumn()
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status','LIKE', "%{$keyword}%");
            })
            ->addColumn('action', function($data){
                $action_array = [
                    'id' => $data->id,
                ];
                $action = '';
                $action .= MenuHelper::TableActionButton($action_array);
                return $action;
            })
            ->addColumn('status', function($data){
                $status = '';
                if($data->status == 'Active'){
                    $status .= '<span class="badge badge-soft-success font-size-11 fw-bold">Active</span>';
                }elseif ($data->status == 'Inactive'){
                    $status .= '<span class="badge badge-soft-pink font-size-11 fw-bold">Inactive</span>';
                }
                return $status;
            })
            ->rawColumns(['action','status']);

        if($make_true != null){
            return $datatable;
        }else{
            return $datatable->make(true);
        }
    }

    public function equipmentsDatatable(array $relations = null, $make_true = null){
        $datatable = \Datatables::of($relations ? $this->model->where('type_id', 3)->with($relations) :
            $this->query())
            ->addIndexColumn()
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status','LIKE', "%{$keyword}%");
            })
            ->addColumn('action', function($data){
                $action_array = [
                    'id' => $data->id,
                ];
                $action = '';
                $action .= MenuHelper::TableActionButton($action_array);
                return $action;
            })
            ->addColumn('status', function($data){
                $status = '';
                if($data->status == 'Active'){
                    $status .= '<span class="badge badge-soft-success font-size-11 fw-bold">Active</span>';
                }elseif ($data->status == 'Inactive'){
                    $status .= '<span class="badge badge-soft-pink font-size-11 fw-bold">Inactive</span>';
                }
                return $status;
            })
            ->rawColumns(['action','status']);

        if($make_true != null){
            return $datatable;
        }else{
            return $datatable->make(true);
        }
    }

    public function selectRawPluckForLogReports(array $params = null)
    {
        return $this->model::where([['status','Active'],[@$params['where']]])->whereNotIn('id',$params['productIds'])->selectRaw(@$params['columns'])->pluck($params['pluck']['key'],$params['pluck']['value']);
    }

}
