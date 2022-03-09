<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Helpers\DataTableHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockReceiveRequest;
use App\Interfaces\StockReceiveInterface;
use App\Models\StockReceive;
use App\Models\Product;
use App\Models\ProductPart;
use App\Models\StockReceiveItem;
use Brian2694\Toastr\Facades\Toastr;
use Google\Service\AdMob\Date;

class StockReceiveController extends Controller
{
    protected $stock_receive;

    public function __construct(StockReceiveInterface $stock_receive)
    {
        $this->stock_receive = $stock_receive;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.stock_receive.{$link}";
    }

    public function index()
    {
        if(request()->ajax()){
            $datatable = $this->stock_receive->datatable(['workshop','fire_station','supplier'],'false');

            $datatable
                ->filterColumn('received_date', function($query, $keyword) {
                    $data = explode('-',$keyword);
                    if(count($data) == 2){
                        $keyword = $data[1].'-'.$data[0];
                    }elseif (count($data) == 3){
                        $keyword = $data[2].'-'.$data[1].'-'.$data[0];
                    }

                    $query->where('received_date','LIKE', "%{$keyword}%");
                })
                ->addColumn('received_date', function($data){
                    if($data->received_date){
                        return date('d-m-Y', strtotime($data->received_date));
                    }else{
                        return '';
                    }

                });
            return $datatable->make(true);
        }else{
            return view($this->path('index'));
        }
    }

    public function deletedListIndex()
    {
        if (request()->ajax()){
            $datatable = $this->stock_receive->deletedDatatable(['workshop','fire_station','supplier'],'false');

            return $datatable->make(true);
        }
    }

    public function create()
    {
        $data = $this->stock_receive->commonData();
        return view($this->path('create'), $data);
    }

    public function store(StockReceiveRequest $request)
    {
        $data = $request;
        $tracking_parameter = [
            'prefix' => 'str'.$request->workshop_id
        ];
        $create_parameters = [
            'create_many' => [
                [
                    'relation' => 'stock_receive_items',
                    'data' => $data->stock_receive_item
                ],
            ],
        ];

        $data['tracking_no'] = CommonHelper::trackingNumber(StockReceiveItem::class,$tracking_parameter);
        $data['received_date'] = date('Y-m-d',strtotime($request->received_date)).' '.date('h:i a');
        $stock_receive = $this->stock_receive->create($data, $create_parameters);
        Toastr::success(trans('stock_receive.created'),trans('common.success'));
        return $stock_receive;
    }

    public function show(StockReceive $stock_receive)
    {
        //
    }

    public function edit(StockReceive $stock_receive)
    {
        $data = $this->stock_receive->commonData();
        $stock_receive->stock_receive_items->map(function($item) use($data) {
            $item['model'] = $item->model;
            $item['item'] = $item->itemable;
            $item['item']->type = $item->itemable->type;
            if($item->type == 'product'){
                $item['items'] = $data['products'];
            }elseif($item->type == 'product_part'){
                $item['items'] = $this->stock_receive->commonData($item)['product_parts'];
            }
            return $item;;
        });

        $data['stock_receive'] = $stock_receive;

        return view($this->path('edit'),$data);
    }

    public function update(StockReceiveRequest $request, StockReceive $stock_receive)
    {
        $data = $request;

        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'stock_receive_items',
                    'data' => $data->stock_receive_item
                ],
            ],
        ];
        $data['received_date'] = date('Y-m-d',strtotime($request->received_date)).' '.date('h:i a');
        $stock_receive = $this->stock_receive->update($stock_receive->id,$data,$update_parameters);
        Toastr::success(trans('stock_receive.updated'),trans('common.success'));
        return $stock_receive;
    }

    public function destroy(StockReceive $stock_receive)
    {
        return $this->stock_receive->delete($stock_receive->id);
    }

    public function restore($id){
        return $this->stock_receive->restore($id);
    }

    public function forceDelete($id){
        return $this->stock_receive->forceDelete($id);
    }

    public function tracking_no(){
        $last_data = StockReceive::max('id');
        if(@$last_data){
            $latest_id = $last_data + 1;
        }else{
            $latest_id = 1;
        }

        $data = 'ws'.date('Ymd').$latest_id;
        return $data;
    }

}
