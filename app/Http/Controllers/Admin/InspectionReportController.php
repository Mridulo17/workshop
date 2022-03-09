<?php

namespace App\Http\Controllers\Admin;


use App\Models\Product;
use App\Models\WorkshopOrder;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InspectionReportRequest;
use App\Interfaces\InspectionReportInterface;
use App\Models\InspectionReport;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class InspectionReportController extends Controller
{

    protected $inspection_report;

    public function __construct(InspectionReportInterface $inspection_report){
        $this->inspection_report = $inspection_report;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.inspection_report.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            $datatable = $this->inspection_report->datatable(['workshopOrder','workshopOrder.faults','workshopOrder.product','workshopOrder.product.model','workshopOrder.product.brand','workshopOrder.product.category','workshopOrder.product.type','demands'],'false');

            $datatable
                ->addColumn('order_date', function($data){
                    return date('d-m-Y', strtotime($data->order_date));
                })
                ->filterColumn('order_date', function($query, $keyword) {
                    $data = explode('-',$keyword);
                    if(count($data) == 2){
                        $keyword = $data[1].'-'.$data[0];
                    } elseif (count($data) == 3){
                        $keyword = $data[2].'-'.$data[1].'-'.$data[0];
                    }
                    $query->where('order_date','LIKE', "%{$keyword}%");
                })
                ->addColumn('product_details', function($data){
                    return $data->workshopOrder->product->tracking_no.', '.$data->workshopOrder->product->model->bn_name.', '.$data->workshopOrder->product->brand->bn_name.' ('.$data->workshopOrder->product->category->bn_name.'-'.$data->workshopOrder->product->type->bn_name.')';
                })
                ->addColumn('faults', function($data){
                    $faults = '';
                    foreach($data->workshopOrder->faults as $key => $fault){
                        $faults.= 1+$key.'. '.$fault->name.'<br>';
                    }
                    return $faults;
                })
                ->addColumn('demands', function($data){
                    $demands = '';
                    foreach($data->demands as $key => $demand){
                        $demands.= 1+$key.'. '.$demand->repair_work.'<br>';
                    }
                    return $demands;
                })
                ->rawColumns(['faults','demands','action']);
            return $datatable->make(true);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->inspection_report->deletedDatatable(['product','driver.employee','faults']);
        }
    }

    public function create(){
        $data = $this->inspection_report->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(InspectionReportRequest $request){
        $data = $request;
        // return $data;
        $tracking_parameter = [
            'prefix' => 'ir'.WorkshopOrder::findOrFail($data->workshop_order_id)->workshop_id
        ];
        $create_parameters = [
            'create_many' => [
                [
                    'relation' => 'demands',
                    'data' => $data->demand_details
                ],
            ],
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(InspectionReport::class,$tracking_parameter);
        return $this->inspection_report->create($data,$create_parameters);
    }

    public function show(InspectionReport $inspection_report){
        return view($this->path('view'),compact('inspection_report'));
    }

    public function edit(InspectionReport $inspection_report){
        $data = $this->inspection_report->commonData($inspection_report);
        return view($this->path('edit'))->with($data);
    }

    public function update(InspectionReportRequest $request, InspectionReport $inspection_report){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'demands',
                    'data' => $data->demand_details
                ],
            ],
        ];
        // return $inspection_report;
        return $this->inspection_report->update($inspection_report->id,$data,$update_parameters);
    }

    public function print($id){
        $inspection_report = $this->inspection_report->find($id);
        $data = [
            'inspection_report'=> $inspection_report,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($inspection_report->tracking_no.'.pdf');
    }

    public function destroy(InspectionReport $inspection_report){
        return $this->inspection_report->delete($inspection_report->id);
    }

    public function restore($id){
        return $this->inspection_report->restore($id);
    }

    public function forceDelete($id){
        return $this->inspection_report->forceDelete($id);
    }

}
