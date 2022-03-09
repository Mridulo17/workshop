<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DivisionRequest;
use App\Models\Division;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.division.{$link}";
    }

    public function index()
    {
        $division = Division::query();
        if(request()->ajax()){
            return \Datatables::of($division)
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
        $data['divisions'] = Division::query()->pluck('bn_name','id');
        return view($this->path('create'))->with($data);
    }

    public function store(DivisionRequest $request)
    {
        try {
            $division = New Division();
            $division->create($request->all());

            \Toastr::success('Division Created', 'Success');
            return redirect(route('division.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Division $division)
    {
        //
    }

    public function edit(Division $division)
    {
        $data['division'] = $division;
        $data['divisions'] = Division::query()->pluck('name','id');
        return view($this->path('edit'))->with($data);
    }

    public function update(DivisionRequest $request, Division $division)
    {
        try {
            $division->update($request->all());
            \Toastr::success('Division Updated', 'Success');
            return redirect(route('division.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Division $division)
    {
        $division->deleted_by = \Auth::id();
        $division->save();
        $division->delete();
        return response()->json([
            'message' => 'Division deleted'
        ]);
    }
}
