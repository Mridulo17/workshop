<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleTransferRequest;
use App\Interfaces\VehicleTransferInterface;
use App\Models\KmplLphRecord;
use App\Models\Product;
use App\Models\VehicleTransfer;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class VehicleTransferController extends Controller
{
    protected $vehicle_transfer;

    public function __construct(VehicleTransferInterface $vehicle_transfer){
        $this->vehicle_transfer = $vehicle_transfer;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.vehicle_transfer.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->vehicle_transfer->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->vehicle_transfer->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->vehicle_transfer->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(VehicleTransferRequest $request){
        $data = $request;
        $vehicle_transfer_details = $request->vehicle_transfer_details;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'vt'.Product::findOrFail($request->product_id)->workshop_id
        ];

        $parameters = [

            'create_many' => [
                [
                    'relation' => 'vehicleTransferDetails',
                    'data' => $vehicle_transfer_details
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
        $data['tracking_no'] = CommonHelper::trackingNumber(VehicleTransfer::class,$tracking_parameter);
        $vehicle_transfer = $this->vehicle_transfer->create($data,$parameters);

        return response()->json([
            'url'=>route('vehicle_transfer.index')
        ], 200);
    }

    public function show(VehicleTransfer $vehicle_transfer){
        return view($this->path('view'),compact('vehicle_transfer'));
    }

    public function edit(VehicleTransfer $vehicle_transfer){
        $data = $this->vehicle_transfer->commonData($vehicle_transfer);
        return view($this->path('edit'))->with($data);
    }

    public function print($id){
        $vehicle_transfer = $this->vehicle_transfer->find($id);
        $data = [
            'vehicle_transfer'=> $vehicle_transfer,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($vehicle_transfer->tracking_no.'.pdf');
    }

    public function update(VehicleTransferRequest $request, VehicleTransfer $vehicle_transfer){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'vehicleTransferDetails',
                    'data' => $data->vehicle_transfer_details,
                ],
            ],
        ];
        $this->vehicle_transfer->update($vehicle_transfer->id,$data,$update_parameters);

        return response()->json([
            'url'=>route('vehicle_transfer.index')
        ], 200);
    }

    public function destroy(VehicleTransfer $vehicle_transfer){
        return $this->vehicle_transfer->delete($vehicle_transfer->id);
    }

    public function restore($id){
        return $this->vehicle_transfer->restore($id);
    }

    public function forceDelete($id){
        return $this->vehicle_transfer->forceDelete($id);
    }
}
