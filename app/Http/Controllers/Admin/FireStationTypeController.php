<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FireStationTypeRequest;
use App\Models\FireStationType;
use Illuminate\Http\Request;

class FireStationTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.fire_station_type.{$link}";
    }

    public function index()
    {

        $fire_station_type = FireStationType::query();
//        dd($fire_station_type);
        if(request()->ajax()){
            return \Datatables::of($fire_station_type)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $action_array = [
                        'id' => $data->id
                    ];
                    $action = \App\Helpers\MenuHelper::TableActionButton($action_array);
                    return $action;
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
        $data['fire_station_types'] = FireStationType::pluck('bn_name','id');
        return view($this->path('create'))->with($data);
    }

    public function store(FireStationTypeRequest $request)
    {
        try {
            $fire_station_type = New FireStationType();
            $fire_station_type->create($request->all());

            \Toastr::success('Fire Station Type Created', 'Success');
            return redirect(route('fire_station_type.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(FireStationType $fire_station_type)
    {
        //
    }

    public function edit(FireStationType $fire_station_type)
    {
        $data['fire_station_type'] = $fire_station_type;
        $data['fire_station_types'] = FireStationType::pluck('name','id');
        return view($this->path('edit'))->with($data);
    }

    public function update(FireStationTypeRequest $request, FireStationType $fire_station_type)
    {
        try {
            $fire_station_type->update($request->all());
            \Toastr::success('Fire Station Type Updated', 'Success');
            return redirect(route('fire_station_type.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(FireStationType $fire_station_type)
    {
        $fire_station_type->deleted_by = \Auth::id();
        $fire_station_type->save();
        $fire_station_type->delete();
        return response()->json([
            'message' => 'Fire Station Type deleted'
        ]);
    }
}
