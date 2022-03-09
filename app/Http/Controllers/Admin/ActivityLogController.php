<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{

    protected function path(string $link){
        return "admin.activity_log.{$link}";
    }

    public function index()
    {
        $activities = Activity::query()->orderBy('id', 'desc')->get();
        if(request()->ajax()){
            return \Datatables::of($activities)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $action_array = [
                        'id' => $data->id
                    ];
                    return MenuHelper::TableActionButton($action_array);
                })
                ->addColumn('subject', function($data){
                    $size = count(explode('\\',$data->subject_type));
                    return explode('\\',$data->subject_type)[$size-1];
                })
                ->addColumn('product', function($data){
                    $products_activity = $data->whereJsonLength('properties->attributes->product_id','>',0)->where('id',$data->id)->first();
                    if ($products_activity){
                        $product = Product::query()->findOrFail($products_activity['properties']['attributes']['product_id']);
                        return strtoupper($product->tracking_no).' ['.$product->registration_number.']';
                    } else {
                        return '';
                    }
                })
                ->addColumn('created_by', function($data){
                    return $data->causer->bn_name ;
                })
                ->addColumn('date_time', function($data){
                    return date('d-m-Y  h:i a', strtotime($data->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view($this->path('index'));
        }

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $activity = Activity::query()->findorfail($id);
        return view($this->path('view'),compact('activity'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
