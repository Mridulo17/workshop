<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FireStationRequest;
use App\Http\Requests\Admin\FireStationTypeRequest;
use App\Models\CityCorporation;
use App\Models\District;
use App\Models\Division;
use App\Models\FireStation;
use App\Models\FireStationType;
use App\Models\Thana;
use Illuminate\Http\Request;

class FireStationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.fire_station.{$link}";
    }

    public function index()
    {

        $fire_station = FireStation::query();
        if(request()->ajax()){
            return \Datatables::of($fire_station)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $action_array = [
                        'id' => $data->id
                    ];
                    $action = \App\Helpers\MenuHelper::TableActionButton($action_array);
                    return $action;
                })
                ->addColumn('division', function($data){
                    return @$data->division->bn_name;
                })
                ->addColumn('district', function($data){
                    return @$data->district->bn_name;
                })
                ->addColumn('thana', function($data){
                    return @$data->thana->bn_name;
                })
                ->addColumn('status', function($data){
                    $status = '';
                    if($data->status == 'Active'){
                        $status .= '<span class="badge badge-soft-success font-size-11 fw-bold">Active</span>';
                    }elseif ($data->status == 'Inactive'){
                        $status .= '<span class="badge badge-soft-pink font-size-11 fw-bold">Inactive</span>';
                    }
                    return $status;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }else{
            return view($this->path('index'));
        }

    }

    public function create()
    {
        $data['fire_station'] = '';
        $data['fire_stations'] = FireStation::pluck('bn_name','id');
        $data['divisions'] = Division::pluck('bn_name','id');
        $data['districts'] = District::pluck('bn_name','id');
        $data['thanas'] = Thana::pluck('bn_name','id');
        $data['fire_station_types'] = FireStationType::pluck('bn_name','id');
        $data['categories'] = array('সিটি কর্পোরেশন','জেলা','উপজেলা');
        return view($this->path('create'))->with($data);
    }

    public function store(FireStationTypeRequest $request)
    {
        try {
            $fire_station = New FireStation();
            $request->request->add(['thana_id' => implode(',', $request->thana_id)]);
            $fire_station->create($request->all());

            \Toastr::success('Fire Station Created', 'Success');
            return redirect(route('fire_station.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(FireStation $fire_station)
    {
        //
    }

    public function edit(FireStation $fire_station)
    {
        $data['fire_station'] = $fire_station;
        $data['fire_stations'] = FireStation::pluck('name','id');
        $data['divisions'] = Division::pluck('bn_name','id');
        $data['districts'] = District::pluck('bn_name','id');
        $data['thanas'] = Thana::where('district_id',$fire_station->district_id)->pluck('bn_name','id');
        $data['fire_station_types'] = FireStationType::pluck('bn_name','id');
        $data['categories'] = array('সিটি কর্পোরেশন' => 'সিটি কর্পোরেশন','জেলা' => 'জেলা','উপজেলা' => 'উপজেলা');
        return view($this->path('edit'))->with($data);
    }

    public function update(FireStationRequest $request, FireStation $fire_station)
    {
        try {
            $request->request->add(['thana_id' => implode(',', $request->thana_id)]);
            $fire_station->update($request->all());
            \Toastr::success('Fire Station Updated', 'Success');
            return redirect(route('fire_station.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(FireStation $fire_station)
    {
        $fire_station->deleted_by = \Auth::id();
        $fire_station->save();
        $fire_station->delete();
        return response()->json([
            'message' => 'Fire Station deleted'
        ]);
    }
}
