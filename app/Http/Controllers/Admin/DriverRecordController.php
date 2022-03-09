<?php

namespace App\Http\Controllers\Admin;

//use App\Helpers\CommonHelper;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverRecordRequest;
use App\Interfaces\DriverRecordInterface;
use App\Models\DriverRecord;
use App\Models\Product;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class DriverRecordController extends Controller
{
    protected $driver_record;

    public function __construct(DriverRecordInterface $driver_record){
        $this->driver_record = $driver_record;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.driver_record.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->driver_record->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->driver_record->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->driver_record->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(DriverRecordRequest $request){
        $data = $request;
        $driver_record_details = $request->driver_record_details;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'dr'.Product::findOrFail($request->product_id)->workshop_id
        ];

        $parameters = [
            'create_many' => [
                [
                    'relation' => 'driverRecordDetails',
                    'data' => $driver_record_details
                ],
            ],

//            'image_info' => [
//                [
//                    'type' => 'substituter_signature',
//                    'images' => $data->substituter_signature,
//                    'directory' => 'substituter_signatures',
//                    'input_field' => 'substituter_signature',
//                    'width' => '',
//                    'height' => '',
//                ],
//                [
//                    'type' => 'sso_signature',
//                    'images' => $data->sso_signature,
//                    'directory' => 'sso_signatures',
//                    'input_field' => 'sso_signature',
//                    'width' => '',
//                    'height' => '',
//                ],
//            ],
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(DriverRecord::class,$tracking_parameter);
        $driver_record = $this->driver_record->create($data,$parameters);

        return response()->json([
            'url'=>route('driver_record.index')
        ], 200);
    }

    public function show(DriverRecord $driver_record){
        return view($this->path('view'),compact('driver_record'));
    }

    public function edit(DriverRecord $driver_record){
        $data = $this->driver_record->commonData($driver_record);
        return view($this->path('edit'))->with($data);
    }

    public function print($id){
        $driver_record = $this->driver_record->find($id);
        $data = [
            'driver_record'=> $driver_record,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($driver_record->tracking_no.'.pdf');
    }

    public function update(DriverRecordRequest $request, DriverRecord $driver_record){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'driverRecordDetails',
                    'data' => $data->driver_record_details
                ],
            ],
        ];

        $this->driver_record->update($driver_record->id,$data,$update_parameters);

        return response()->json([
            'url'=>route('driver_record.index')
        ], 200);
    }

    public function destroy(DriverRecord $driver_record){
        return $this->driver_record->delete($driver_record->id);
    }

    public function restore($id){
        return $this->driver_record->restore($id);
    }

    public function forceDelete($id){
        return $this->driver_record->forceDelete($id);
    }
}
