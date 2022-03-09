<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterChangeRecordRequest;
use App\Interfaces\FilterChangeRecordInterface;
use App\Models\FilterChangeRecord;
use App\Models\Product;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class FilterChangeRecordController extends Controller
{
    protected $filter_change_record;

    public function __construct(FilterChangeRecordInterface $filter_change_record){
        $this->filter_change_record = $filter_change_record;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.filter_change_record.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->filter_change_record->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->filter_change_record->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->filter_change_record->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(FilterChangeRecordRequest $request){
        $data = $request;
        $filter_change_details = $request->filter_change_details;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'fcr'.Product::findOrFail($request->product_id)->workshop_id
        ];
        $parameters = [
            'create_many' => [
                [
                    'relation' => 'filterChangeDetails',
                    'data' => $filter_change_details
                ],
            ],
            /*'image_info' => [
                [
                    'type' => 'substitutor_signature',
                    'images' => $data->substitutor_signature,
                    'directory' => 'substitutor_signatures',
                    'input_field' => 'substitutor_signature',
                    'width' => '',
                    'height' => '',
                ],
                [
                    'type' => 'sso_signature',
                    'images' => $data->sso_signature,
                    'directory' => 'sso_signatures',
                    'input_field' => 'sso_signature',
                    'width' => '',
                    'height' => '',
                ],
            ],*/
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(FilterChangeRecord::class,$tracking_parameter);

        $this->filter_change_record->create($data,$parameters);

        return response()->json([
            'url'=>route('filter_change_record.index')
        ], 200);
    }

    public function show(FilterChangeRecord $filter_change_record){
        return view($this->path('view'),compact('filter_change_record'));
    }

    public function edit(FilterChangeRecord $filter_change_record){
        $data = $this->filter_change_record->commonData($filter_change_record);
        return view($this->path('edit'))->with($data);
    }

    public function update(FilterChangeRecordRequest $request, FilterChangeRecord $filter_change_record){
        $data = $request;
        $data['change_date'] = $request->change_date ? date('Y-m-d',strtotime($request->change_date)) : null;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'filterChangeDetails',
                    'data' => $data->filter_change_details
                ],
            ],
        ];

        $this->filter_change_record->update($filter_change_record->id,$data,$update_parameters);

        return response()->json([
            'url'=>route('filter_change_record.index')
        ], 200);
    }

    public function destroy(FilterChangeRecord $filter_change_record){
        return $this->filter_change_record->delete($filter_change_record->id);
    }

    public function print($id){
        $filter_change_record = $this->filter_change_record->find($id);
        $data = [
            'filter_change_record'=> $filter_change_record,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
        return $pdf->stream($filter_change_record->tracking_no.'.pdf');
    }

    public function restore($id){
        return $this->filter_change_record->restore($id);
    }

    public function forceDelete($id){
        return $this->filter_change_record->forceDelete($id);
    }
}
