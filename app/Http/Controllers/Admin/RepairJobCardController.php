<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RepairJobCardRequest;
use App\Interfaces\RepairJobCardInterface;
use App\Models\InspectionReport;
use App\Models\ProductPart;
use App\Models\RepairJobCard;
use App\Models\WorkshopOrder;
use App\Models\Product;
use App\Models\Workshop;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class RepairJobCardController extends Controller
{
    protected $repair_job_card;

    public function __construct(RepairJobCardInterface $repair_job_card){
        $this->repair_job_card = $repair_job_card;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.repair_job_card.{$link}";
    }
    public function index(){
        if(request()->ajax()){

            $datatable = $this->repair_job_card->datatable(['inspectionReport','inspectionReport.workshopOrder','inspectionReport.workshopOrder.workshop','inspectionReport.workshopOrder.product','inspectionReport.workshopOrder.product.type','inspectionReport.workshopOrder.product.model',
                'inspectionReport.workshopOrder.product.brand','inspectionReport.workshopOrder.product.fire_station',
                'inspectionReport.workshopOrder.product.category'],'false');

//            $datatable
//                ->addColumn('product_details', function($data){
//                    return $data->inspection_report->workshop_order->product->tracking_no.', '.$data->inspection_report->workshop_order->product->model->bn_name.', '.$data->repair_job_card->inspection_report->workshop_order->product->brand->bn_name.'('.$data->repair_job_card->inspection_report->workshop_order->product->category->bn_name.'-'.$data->repair_job_card->inspection_report->workshop_order->product->type->bn_name.')';
//                });

//                ->rawColumns(['action']);
            return $datatable->make(true);
        }
        return view($this->path('index'));
    }


    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->repair_job_card->deletedDatatable(['inspectionReport','inspectionReport.workshopOrder','inspectionReport.workshopOrder.product','inspectionReport.workshopOrder.product.type','inspectionReport.workshopOrder.product.model',
                'inspectionReport.workshopOrder.product.brand','inspectionReport.workshopOrder.product.category']);
        }
    }

    public function create(){
        $data = $this->repair_job_card->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(RepairJobCardRequest $request){
        $data = $request;
        $repair_job_cards = $request->repair_job_cards;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'rjb'.InspectionReport::findOrFail($request->inspection_report_id)->workshop_order_id
        ];
        $create_parameters = [
            'create_many' => [
                [
                    'relation' => 'repairJobCardDetails',
                    'data' => $data->repairJobCardDetails
                ],
            ],
        ];
        $data['job_card_registration'] = CommonHelper::trackingNumber(RepairJobCard::class,$tracking_parameter);
        return $this->repair_job_card->create($data,$create_parameters);
    }

    public function show(RepairJobCard $repair_job_card){
        return view($this->path('view'),compact('repair_job_card'));
    }

    public function update(RepairJobCardRequest $request, RepairJobCard $repair_job_card){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'repairJobCardDetails',
                    'data' => $data->repairJobCardDetails
                ],
            ],
        ];
        return $this->repair_job_card->update($repair_job_card->id,$data,$update_parameters);
    }

    public function edit(RepairJobCard $repair_job_card){
        $data = $this->repair_job_card->commonData($repair_job_card);
        return view($this->path('edit'))->with($data);
    }

    public function print($id){
        $repair_job_card = $this->repair_job_card->find($id);
        $data = [
            'repair_job_card'=> $repair_job_card,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($repair_job_card->job_card_registration.'.pdf');
    }

    public function destroy(RepairJobCard $repair_job_card){
        return $this->repair_job_card->delete($repair_job_card->id);
    }

    public function restore($id){
        return $this->repair_job_card->restore($id);
    }

    public function forceDelete($id){
        return $this->repair_job_card->forceDelete($id);
    }
}
