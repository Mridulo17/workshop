<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BatteryRecordRequest;
use App\Interfaces\BatteryRecordInterface;
use App\Models\BatteryRecord;
use App\Models\Product;
use App\Models\Workshop;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class BatteryDetailController extends Controller
{
    protected $battery_record;

    public function __construct(BatteryRecordInterface $battery_record){
        $this->battery_record = $battery_record;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.battery_record.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->battery_record->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->battery_record->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->battery_record->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(BatteryRecordRequest $request){
        $data = $request;
        $battery_records = $request->battery_records;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'lrm'.Product::query()->findOrFail($request->product_id)->workshop_id
        ];
        $parameters = [
            'create_many' => [
                [
                    'relation' => 'batteryDetails',
                    'data' => $battery_records
                ],
            ],
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(BatteryRecord::class,$tracking_parameter);
        $battery_record = $this->battery_record->create($data,$parameters);

        return $battery_record;
    }

    public function show(BatteryRecord $battery_record){
        return view($this->path('view'),compact('battery_record'));
    }

    public function edit(BatteryRecord $battery_record){
        $data = $this->battery_record->commonData($battery_record);
        return view($this->path('edit'))->with($data);
    }

    public function update(BatteryRecordRequest $request, BatteryRecord $battery_record){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'batteryDetails',
                    'data' => $data->battery_records
                ],
            ],
        ];
        return $this->battery_record->update($battery_record->id,$data,$update_parameters);
    }

    public function print($id){
        $battery_record = $this->battery_record->find($id);
        $data = [
            'battery_record'=> $battery_record,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($battery_record->tracking_no.'.pdf');
    }

    public function destroy(BatteryRecord $battery_record){
        return $this->battery_record->delete($battery_record->id);
    }

    public function restore($id){
        return $this->battery_record->restore($id);
    }

    public function forceDelete($id){
        return $this->battery_record->forceDelete($id);
    }
}
