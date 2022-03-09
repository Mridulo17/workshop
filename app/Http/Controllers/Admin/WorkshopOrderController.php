<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkshopOrderRequest;
use App\Interfaces\WorkshopOrderInterface;
use App\Models\WorkshopOrder;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class WorkshopOrderController extends Controller
{
    protected $workshop_order;

    public function __construct(WorkshopOrderInterface $workshop_order){
        $this->workshop_order = $workshop_order;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.workshop_order.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            $datatable = $this->workshop_order->datatable(['product','product.model','product.model.brand','driver.employee','faults'],'false');

            $datatable
                ->addColumn('order_date', function($data){
                    return date('d-m-Y', strtotime($data->order_date));
                })
                ->filterColumn('order_date', function($query, $keyword) {
                    $data = explode('-',$keyword);
                    if(count($data) == 2){
                        $keyword = $data[1].'-'.$data[0];
                    }elseif (count($data) == 3){
                        $keyword = $data[2].'-'.$data[1].'-'.$data[0];
                    }
                    $query->where('order_date','LIKE', "%{$keyword}%");
                })
                ->addColumn('product_details', function($data){
                    return $data->product->tracking_no.', '.$data->product->model->bn_name.', '.$data->product->model->brand->bn_name.' ('.$data->product->category->bn_name.'-'.$data->product->type->bn_name.')';
                })
                ->addColumn('faults', function($data){
                    $faults = '';
                        foreach($data->faults as $key => $fault){
                            $faults.= 1+$key.'. '.$fault->name.'<br>';
                        }
                    return $faults;
                })
                ->rawColumns(['faults','action']);
            return $datatable->make(true);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->workshop_order->deletedDatatable(['product','driver.employee','faults']);
        }
    }

    public function create(){
        $data = $this->workshop_order->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(WorkshopOrderRequest $request){
        $data = $request;
        $tracking_parameter = [
            'prefix' => 'wso'.$request->workshop_id
        ];
        $create_parameters = [
            'create_many' => [
                [
                    'relation' => 'faults',
                    'data' => $data->fault
                ],
            ],
        ];

        $data['tracking_no'] = CommonHelper::trackingNumber(WorkshopOrder::class,$tracking_parameter);
        $data['order_date'] = date('Y-m-d',strtotime($request->order_date)).' '.date('h:i a');
        return $this->workshop_order->create($data,$create_parameters);
    }

    public function show(WorkshopOrder $workshop_order){
        return view($this->path('view'),compact('workshop_order'));
    }

    public function edit(WorkshopOrder $workshop_order){
        $data = $this->workshop_order->commonData($workshop_order);
        return view($this->path('edit'))->with($data);
    }

    public function update(WorkshopOrderRequest $request, WorkshopOrder $workshop_order){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'faults',
                    'data' => $data->fault
                ],
            ],
        ];
        $data['order_date'] = date('Y-m-d',strtotime($request->order_date)).' '.date('h:i a');
        return $this->workshop_order->update($workshop_order->id,$data,$update_parameters);
    }

    public function print($id){
        $workshop_order = $this->workshop_order->find($id);
        $data = [
            'workshop_order'=> $workshop_order,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($workshop_order->tracking_no.'.pdf');
    }

    public function destroy(WorkshopOrder $workshop_order){
        return $this->workshop_order->delete($workshop_order->id);
    }

    public function restore($id){
        return $this->workshop_order->restore($id);
    }

    public function forceDelete($id){
        return $this->workshop_order->forceDelete($id);
    }

}
