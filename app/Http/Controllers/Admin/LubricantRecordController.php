<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LubricantRecordRequest;
use App\Interfaces\LubricantRecordInterface;
use App\Models\LubricantRecord;
use App\Models\Product;
use App\Models\Workshop;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class LubricantRecordController extends Controller
{
    protected $lubricant_record;

    public function __construct(LubricantRecordInterface $lubricant_record){
        $this->lubricant_record = $lubricant_record;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.lubricant_record.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->lubricant_record->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->lubricant_record->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->lubricant_record->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(LubricantRecordRequest $request){
        $data = $request;
        $lubricants = $request->lubricants;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'lrm'.Product::findOrFail($request->product_id)->workshop_id
        ];
        $parameters = [
            'create_many' => [
                [
                    'relation' => 'lubricantDetails',
                    'data' => $lubricants
                ],
            ],
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(LubricantRecord::class,$tracking_parameter);
        $this->lubricant_record->create($data,$parameters);

        return response()->json([
            'url'=>route('lubricant_record.index')
        ], 200);
    }

    public function show(LubricantRecord $lubricant_record){
        return view($this->path('view'),compact('lubricant_record'));
    }

    public function edit(LubricantRecord $lubricant_record){
        $data = $this->lubricant_record->commonData($lubricant_record);
        return view($this->path('edit'))->with($data);
    }

    public function update(LubricantRecordRequest $request, LubricantRecord $lubricant_record){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'lubricantDetails',
                    'data' => $data->lubricants
                ],
            ],
        ];

        $this->lubricant_record->update($lubricant_record->id,$data,$update_parameters);
        return response()->json([
            'url'=>route('lubricant_record.index')
        ], 200);
    }

    public function print($id){
        $lubricant_record = $this->lubricant_record->find($id);
        $data = [
            'lubricant_record'=> $lubricant_record,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);

        return $pdf->stream($lubricant_record->tracking_no.'.pdf');
    }

    public function destroy(LubricantRecord $lubricant_record){
        return $this->lubricant_record->delete($lubricant_record->id);
    }

    public function restore($id){
        return $this->lubricant_record->restore($id);
    }

    public function forceDelete($id){
        return $this->lubricant_record->forceDelete($id);
    }
}
