<?php

namespace App\Http\Controllers\Admin;

//use App\Helpers\CommonHelper;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KmplLphRecordRequest;
use App\Interfaces\KmplLphRecordInterface;
use App\Models\KmplLphRecord;
use App\Models\Product;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class KmplLphRecordController extends Controller
{
    protected $kmpl_lph_record;

    public function __construct(KmplLphRecordInterface $kmpl_lph_record){
        $this->kmpl_lph_record = $kmpl_lph_record;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.kmpl_lph_record.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->kmpl_lph_record->datatable(['product','product.type','product.category','product.brand','product.model']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->kmpl_lph_record->deletedDatatable(['product','product.type','product.category','product.brand','product.model']);
        }
    }

    public function create(){
        $data = $this->kmpl_lph_record->commonData();
        return view($this->path('create'))->with($data);
    }

    public function store(KmplLphRecordRequest $request){
        $data = $request;
        $kmpl_lph_details = $request->kmpl_lph_details;
        $data['entry_type'] = 'manual';
        $tracking_parameter = [
            'prefix' => 'kmpl'.Product::findOrFail($request->product_id)->workshop_id
        ];

        $parameters = [
            'create_many' => [
                [
                    'relation' => 'kmplLphDetails',
                    'data' => $kmpl_lph_details
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
        $data['tracking_no'] = CommonHelper::trackingNumber(KmplLphRecord::class,$tracking_parameter);
        $kmpl_lph_record = $this->kmpl_lph_record->create($data,$parameters);

        return $kmpl_lph_record;
    }

    public function show(KmplLphRecord $kmpl_lph_record){
        return view($this->path('view'),compact('kmpl_lph_record'));
    }

    public function edit(KmplLphRecord $kmpl_lph_record){
        $data = $this->kmpl_lph_record->commonData($kmpl_lph_record);
        return view($this->path('edit'))->with($data);
    }

    public function update(KmplLphRecordRequest $request, KmplLphRecord $kmpl_lph_record){
        $data = $request;
        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'kmplLphDetails',
                    'data' => $data->kmpl_lph_details
                ],
            ],
        ];

        return $this->kmpl_lph_record->update($kmpl_lph_record->id,$data,$update_parameters);
    }

    public function print($id){
        $kmpl_lph_record = $this->kmpl_lph_record->find($id);
        $data = [
            'kmpl_lph_record'=> $kmpl_lph_record,
        ];
        $pdf = PDF::loadView($this->path('print'),
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'P',
            ]);
//        dd($kmpl_lph_record);

        return $pdf->stream($kmpl_lph_record->tracking_no.'.pdf');
    }

    public function destroy(KmplLphRecord $kmpl_lph_record){
        return $this->kmpl_lph_record->delete($kmpl_lph_record->id);
    }

    public function restore($id){
        return $this->kmpl_lph_record->restore($id);
    }

    public function forceDelete($id){
        return $this->kmpl_lph_record->forceDelete($id);
    }
}
