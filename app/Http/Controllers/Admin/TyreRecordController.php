<?php

namespace App\Http\Controllers\Admin;

//use App\Helpers\CommonHelper;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TyreRecordRequest;
use App\Interfaces\TyreRecordInterface;
use App\Models\Product;
use App\Models\TyreRecord;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class TyreRecordController extends Controller
{
    protected $tyre_record;

    public function __construct(TyreRecordInterface $tyre_record){
        $this->tyre_record = $tyre_record;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.tyre_record.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->tyre_record->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->tyre_record->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->tyre_record->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(TyreRecordRequest $request){
        $data = $request;
        $tyre_record_details = $request->tyre_record_details;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'tr'.Product::findOrFail($request->product_id)->workshop_id
        ];
        $parameters = [
            'create_many' => [
                [
                    'relation' => 'tyreRecordDetails',
                    'data' => $tyre_record_details
                ],
            ],
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(TyreRecord::class,$tracking_parameter);
        $this->tyre_record->create($data,$parameters);

        return response()->json([
            'url' => route('tyre_record.index')
        ], 200);
    }

    public function show(TyreRecord $tyre_record){
        return view($this->path('view'),compact('tyre_record'));
    }

    public function edit(TyreRecord $tyre_record){
        $data = $this->tyre_record->commonData($tyre_record);
        return view($this->path('edit'))->with($data);
    }

    public function print($id){
        $tyre_record = $this->tyre_record->find($id);
        $data = [
            'tyre_record'=> $tyre_record,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
                'default_font' => 'bentonsans',
            ]);
        return $pdf->stream($tyre_record->tracking_no.'.pdf');
    }

    public function update(TyreRecordRequest $request, TyreRecord $tyre_record){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'tyreRecordDetails',
                    'data' => $data->tyre_record_details
                ],
            ],
        ];

        return $this->tyre_record->update($tyre_record->id,$data,$update_parameters);
    }

    public function destroy(TyreRecord $tyre_record){
        return $this->tyre_record->delete($tyre_record->id);
    }

    public function restore($id){
        return $this->tyre_record->restore($id);
    }

    public function forceDelete($id){
        return $this->tyre_record->forceDelete($id);
    }
}
