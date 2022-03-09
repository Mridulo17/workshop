<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleMaintenanceOrderRequest;
use App\Interfaces\VehicleMaintenanceOrderInterface;
use App\Models\Employee;
use App\Models\Product;
use App\Models\VehicleMaintenanceOrder;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class VehicleMaintenanceOrderController extends Controller
{
    protected $vehicle_maintenance_order;

    public function __construct(VehicleMaintenanceOrderInterface $vehicle_maintenance_order){
        $this->vehicle_maintenance_order = $vehicle_maintenance_order;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.vehicle_maintenance_order.{$link}";
    }

    public function index(){

        if(request()->ajax()){
            return $this->vehicle_maintenance_order->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->vehicle_maintenance_order->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->vehicle_maintenance_order->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(VehicleMaintenanceOrderRequest $request){
        $data = $request;
        $vehicle_maintenance_orders = $request->vehicle_maintenance_orders;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'vmo'.Product::findOrFail($request->product_id)->workshop_id
        ];
        $parameters = [
            'create_many' => [
                [
                    'relation' => 'vehicleMaintenanceDetails',
                    'data' => $vehicle_maintenance_orders
                ],
            ],

        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(VehicleMaintenanceOrder::class,$tracking_parameter);
        $vehicle_maintenance_order = $this->vehicle_maintenance_order->create($data,$parameters);

        return $vehicle_maintenance_order;
    }

    public function show(VehicleMaintenanceOrder $vehicle_maintenance_order){
        $employees = Employee::all();
        return view($this->path('view'),compact('vehicle_maintenance_order', 'employees'));
    }

    public function edit(VehicleMaintenanceOrder $vehicle_maintenance_order){
        $data = $this->vehicle_maintenance_order->commonData($vehicle_maintenance_order);
//        dd($this->vehicle_maintenance_order);
        return view($this->path('edit'))->with($data);
    }

    public function print($id){
        $vehicle_maintenance_order = $this->vehicle_maintenance_order->find($id);
        $data = [
            'vehicle_maintenance_order'=> $vehicle_maintenance_order,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($vehicle_maintenance_order->tracking_no.'.pdf');
    }

    public function update(VehicleMaintenanceOrderRequest $request, VehicleMaintenanceOrder $vehicle_maintenance_order){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'vehicleMaintenanceDetails',
                    'data' => $data->vehicle_maintenance_orders
                ],
            ],
        ];

        return $this->vehicle_maintenance_order->update($vehicle_maintenance_order->id,$data,$update_parameters);
    }

    public function destroy(VehicleMaintenanceOrder $vehicle_maintenance_order){
        return $this->vehicle_maintenance_order->delete($vehicle_maintenance_order->id);
    }

    public function restore($id){
        return $this->vehicle_maintenance_order->restore($id);
    }

    public function forceDelete($id){
        return $this->vehicle_maintenance_order->forceDelete($id);
    }
}
