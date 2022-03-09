<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Interfaces\ModelInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\StockReceiveInterface;
use App\Models\District;
use App\Models\Division;
use App\Models\FireStation;
use App\Models\Model;
Use App\Models\Product;
use App\Models\ProductType;
use App\Models\StockReceiveItem;
use App\Models\Thana;
use App\Models\Type;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $product;
    protected $product_model;
    protected $stock_receive;
    protected $deleted_relation;

    public function __construct(
        ProductInterface $product,
        ModelInterface $product_model,
        StockReceiveInterface $stock_receive
    )
    {
        $this->product = $product;
        $this->product_model = $product_model;
        $this->stock_receive = $stock_receive;
        $this->deleted_relation = ['stock_receive_items'];
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.product.{$link}";
    }

    public function index(Request $request)
    {

        $data['workshop_id'] = $request->workshop_id;
        $data['types'] = Type::pluck('bn_name','id');
        $data['workshops'] = Workshop::pluck('bn_name','id');
        $data['divisions'] = Division::pluck('bn_name','id');
        $data['districts'] = District::pluck('bn_name','id');
        $data['thanas'] = Thana::pluck('bn_name','id');
        $data['fire_stations'] = FireStation::pluck('bn_name','id');
        $data['active_tab'] = $request->tab;
        $data['search_data'] = $request->all();
        $form_input = $request->all();
//        $form_input['map_location'] = request('workshop_id');

        if(request()->ajax()){

            $datatable = $this->product->datatable(['fire_station','type','category','brand','model'],null,
                $form_input);
            return $datatable;
        }
        return view($this->path('index'),$data);
    }



    public function vehicles()
    {
        if(request()->ajax()){
            $datatable = $this->product->vehiclesDatatable(['fire_station','type','category','brand','model']);
            return $datatable;
        }
    }

    public function pumps()
    {
        if(request()->ajax()){
            $datatable = $this->product->pumpsDatatable(['fire_station','type','category','brand','model']);
            return $datatable;
        }
    }

    public function equipments()
    {
        if(request()->ajax()){
            $datatable = $this->product->equipmentsDatatable(['fire_station','type','category','brand','model']);
            return $datatable;
        }
    }

    public function deletedListIndex()
    {
        if (request()->ajax()){
            $datatable = $this->product->deletedDatatable(['type','category','brand','model'],);
            return $datatable;
        }
    }

    public function create()
    {
        $data = $this->product->commonData();


        return view($this->path('create'))->with($data);
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request;
            $tracking_parameter = [
                'prefix' => 'p'.$request->type_id,
            ];
            $data['tracking_no'] = CommonHelper::trackingNumber(Product::class,$tracking_parameter);
            $data['entry_date'] = $request->entry_date ? date('Y-m-d',strtotime($request->entry_date)).' '.date('h:i a') : null;

            $create_parameters = [
                'image_info' => [
                    [
                        'type' => 'image',
                        'images' => $data->images,
                        'directory' => 'product',
                    ],
                ]
            ];
            $product = $this->product->create($data,$create_parameters);

            $data = $this->stockReceive($product->getData()->data);
            session()->put('success',trans('common.tracking_no').': '.$product->getData()->data->tracking_no);
            DB::commit();
            return $product;
        }catch (\Exception $e){
            DB::rollBack();
            if($data->ajax() == true){
                return response()->json($e->getMessage(), 500);
            }
        }

    }

    public function show(Product $product)
    {
        return view($this->path('view'),compact('product'));
    }

    public function edit(Product $product)
    {
        $data = $this->product->commonData($product);
        $data['product'] = $product;
        $data['models'] = $this->product_model->pluck(['brand_id'=> $product->brand_id]);
        return view($this->path('edit'))->with($data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request;
        $data['entry_date'] = $request->entry_date ? date('Y-m-d',strtotime($request->entry_date)).' '.date('h:i a') : null;

        $update_parameters = [
            'image_info' => [
                [
                    'type' => 'image',
                    'images' => $data->images,
                    'directory' => 'product',
                ],
            ]
        ];
        return $product = $this->product->update($product->id,$data,$update_parameters);
    }

    public function destroy(Product $product){
        return $this->product->delete($product->id, $this->deleted_relation);
    }

    public function restore($id){
        return $this->product->restore($id, $this->deleted_relation);
    }

    public function forceDelete($id){
        return $this->product->forceDelete($id, $this->deleted_relation);
    }

    public function stockReceive($product){
        $tracking_parameter = [
            'prefix' => 'str'
        ];
        $data = [
            'tracking_no' => CommonHelper::trackingNumber(StockReceiveItem::class,$tracking_parameter),
            'workshop_id' => $product->workshop_id,
            'fire_station_id' => $product->fire_station_id,
            'received_date' => $product->entry_date ? date('Y-m-d',strtotime($product->entry_date)).' '.date('h:i a') : date('Y-m-d',strtotime($product->created_at)),
        ];
        $create_parameters = [
            'create_many' => [
                [
                    'relation' => 'stock_receive_items',
                    'data' => [
                        [
                            'model_id' => $product->model_id,
                            'itemable_type' => Product::class,
                            'itemable_id' => $product->id,
                            'type' => 'product',
                            'received_qty' => 1,
                        ]
                    ]
                ],
            ],
        ];
        $stock_receive = $this->stock_receive->create(new \Illuminate\Http\Request($data), $create_parameters);

        return $stock_receive;

    }

    /*public function driverAssignCreate(){
        return view($this->path('driver_assign.create'));
    }

    public function driverAssignStore(Request $request)
    {
        $data = $request;
        dd($data);
        return $this->product->create($data);
    }*/

}
