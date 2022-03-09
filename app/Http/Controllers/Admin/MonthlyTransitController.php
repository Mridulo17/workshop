<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MonthlyTransitRequest;
use App\Interfaces\MonthlyTransitInterface;
use App\Models\MonthlyTransit;
use App\Models\Product;
use App\Models\Workshop;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class MonthlyTransitController extends Controller
{
    protected $monthly_transit;

    public function __construct(MonthlyTransitInterface $monthly_transit){
        $this->monthly_transit = $monthly_transit;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.monthly_transit.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->monthly_transit->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->monthly_transit->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->monthly_transit->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(MonthlyTransitRequest $request){
        $data = $request;
        $monthly_transit_details = $request->monthly_transit_details;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'mt'.Product::findOrFail($request->product_id)->workshop_id
        ];
        $parameters = [
            'create_many' => [
                [
                    'relation' => 'monthlyTransitDetails',
                    'data' => $monthly_transit_details
                ],
            ],
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(MonthlyTransit::class,$tracking_parameter);
        $monthly_transit = $this->monthly_transit->create($data,$parameters);
        return $monthly_transit;
    }

    public function show(MonthlyTransit $monthly_transit){
        return view($this->path('view'),compact('monthly_transit'));
    }

    public function edit(MonthlyTransit $monthly_transit){
        $data = $this->monthly_transit->commonData($monthly_transit);
        return view($this->path('edit'))->with($data);
    }

    public function update(MonthlyTransitRequest $request, MonthlyTransit $monthly_transit){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'monthlyTransitDetails',
                    'data' => $data->monthly_transit_details
                ],
            ],
        ];
        return $this->monthly_transit->update($monthly_transit->id,$data,$update_parameters);
    }

    public function print($id){
        $monthly_transit = $this->monthly_transit->find($id);
        $data = [
            'monthly_transit'=> $monthly_transit,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($monthly_transit->tracking_no.'.pdf');
    }

    public function destroy(MonthlyTransit $monthly_transit){
        return $this->monthly_transit->delete($monthly_transit->id);
    }

    public function restore($id){
        return $this->monthly_transit->restore($id);
    }

    public function forceDelete($id){
        return $this->monthly_transit->forceDelete($id);
    }
}
