<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RepairSummaryRequest;
use App\Interfaces\RepairSummaryInterface;
use App\Models\FilterChangeRecord;
use App\Models\Product;
use App\Models\RepairSummary;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class RepairSummaryController extends Controller
{
    protected $repair_summary;

    public function __construct(RepairSummaryInterface $repair_summary){
        $this->repair_summary = $repair_summary;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.repair_summary.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->repair_summary->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->repair_summary->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->repair_summary->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(RepairSummaryRequest $request){
        $data = $request;
        $repair_summary_details = $request->repair_summary_details;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'rs'.Product::findOrFail($request->product_id)->workshop_id
        ];
        $parameters = [
            'create_many' => [
                [
                    'relation' => 'repairSummaryDetails',
                    'data' => $repair_summary_details
                ],
            ],
            /*'image_info' => [
                [
                    'type' => 'workshop_employee_signature',
                    'images' => $data->workshop_employee_signature,
                    'directory' => 'workshop_employee_signatures',
                    'input_field' => 'workshop_employee_signature',
                    'width' => '',
                    'height' => '',
                ],
            ],*/
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(RepairSummary::class,$tracking_parameter);
        $this->repair_summary->create($data,$parameters);

        return response()->json([
            'url'=>route('repair_summary.index')
        ], 200);
    }

    public function show(RepairSummary $repair_summary){
        return view($this->path('view'),compact('repair_summary'));
    }

    public function edit(RepairSummary $repair_summary){
        $data = $this->repair_summary->commonData($repair_summary);
        return view($this->path('edit'))->with($data);
    }

    public function update(RepairSummaryRequest $request, RepairSummary $repair_summary){

        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'repairSummaryDetails',
                    'data' => $data->repair_summary_details
                ],
            ],
        ];

        $this->repair_summary->update($repair_summary->id, $data, $update_parameters);

        return response()->json([
            'url'=>route('repair_summary.index')
        ], 200);
    }

    public function print($id){
        $repair_summary = $this->repair_summary->find($id);
        $data = [
            'repair_summary'=> $repair_summary,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($repair_summary->tracking_no.'.pdf');
    }

    public function destroy(RepairSummary $repair_summary){
        return $this->repair_summary->delete($repair_summary->id);
    }

    public function restore($id){
        return $this->repair_summary->restore($id);
    }

    public function forceDelete($id){
        return $this->repair_summary->forceDelete($id);
    }
}
