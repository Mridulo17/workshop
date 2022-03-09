<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DistrictRequest;
use App\Models\Division;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.district.{$link}";
    }

    public function index()
    {
        $district = District::query();
        if(request()->ajax()){
            return \Datatables::of($district)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $action_array = [
                        'id' => $data->id
                    ];
                    $action = \App\Helpers\MenuHelper::TableActionButton($action_array);
                    return $action;
                })
                ->addColumn('division_name', function($data){
                    return $data->division->bn_name;
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
        $data['districts'] = District::query()->pluck('bn_name','id');
        $data['divisions'] = Division::query()->pluck('bn_name','id');
        return view($this->path('create'))->with($data);
    }

    public function store(DistrictRequest $request)
    {
        try {
            $district = New District();
            $district->create($request->all());

            \Toastr::success('District Created', 'Success');
            return redirect(route('district.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(District $district)
    {
        //
    }

    public function edit(District $district)
    {
        $data['district'] = $district;
        $data['districts'] = District::query()->pluck('name','id');
        $data['divisions'] = Division::query()->pluck('bn_name','id');
        return view($this->path('edit'))->with($data);
    }

    public function update(DistrictRequest $request, District $district)
    {
        try {
            $district->update($request->all());
            \Toastr::success('District Updated', 'Success');
            return redirect(route('district.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(District $district)
    {
        $district->deleted_by = \Auth::id();
        $district->save();
        $district->delete();
        return response()->json([
            'message' => 'Greater District deleted'
        ]);
    }
}
