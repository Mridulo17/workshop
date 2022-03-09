<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InspectionTestingRequest;
use App\Interfaces\InspectionTestingInterface;
use App\Models\InspectionTesting;
use App\Models\InspectionTestingDetail;
use App\Models\Employee;
use App\Models\Product;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class InspectionTestingController extends Controller
{
    protected $inspection_testing;

    public function __construct(InspectionTestingInterface $inspection_testing){
        $this->inspection_testing = $inspection_testing;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.inspection_testing.{$link}";
    }

    public function index(){

        if(request()->ajax()){
            return $this->inspection_testing->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->inspection_testing->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->inspection_testing->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(InspectionTestingRequest $request){
        $data = $request;
        $inspection_testing_details = $request->inspection_testing_details;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'it'.Product::findOrFail($request->product_id)->workshop_id
        ];
        $parameters = [
            'create_many' => [
                [
                    'relation' => 'inspectionTestingDetails',
                    'data' => $inspection_testing_details
                ],
            ],
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(InspectionTesting::class,$tracking_parameter);
        $inspection_testing = $this->inspection_testing->create($data,$parameters);

        return response()->json([
            'url'=>route('inspection_testing.index')
        ], 200);

    }

    public function show(InspectionTesting $inspection_testing){
        $employees = Employee::all();
        return view($this->path('view'),compact('inspection_testing',));
    }

    public function edit(InspectionTesting $inspection_testing){
        $data = $this->inspection_testing->commonData($inspection_testing);
        return view($this->path('edit'))->with($data);
    }

    public function print($id){
        $inspection_testing = $this->inspection_testing->find($id);
        $data = [
            'inspection_testing'=> $inspection_testing,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($inspection_testing->tracking_no.'.pdf');
    }

    public function update(InspectionTestingRequest $request, InspectionTesting $inspection_testing){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'inspectionTestingDetails',
                    'data' => $data->inspection_testing_details
                ],
            ],
        ];

        $this->inspection_testing->update($inspection_testing->id,$data,$update_parameters);

        return response()->json([
                'url'=>route('inspection_testing.index')
            ], 200);
    }

    public function destroy(InspectionTesting $inspection_testing){
        return $this->inspection_testing->delete($inspection_testing->id);
    }

    public function restore($id){
        return $this->inspection_testing->restore($id);
    }

    public function forceDelete($id){
        return $this->inspection_testing->forceDelete($id);
    }
}
