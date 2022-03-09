<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ThanaRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;

class ThanaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.thana.{$link}";
    }

    public function index()
    {

        $thana = Thana::query();
//        dd($thana);
        if(request()->ajax()){
            return \Datatables::of($thana)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $action_array = [
                        'id' => $data->id
                    ];
                    $action = \App\Helpers\MenuHelper::TableActionButton($action_array);
                    return $action;
                })
                ->addColumn('division_name', function($data){
                    return @$data->district->division->bn_name;
                })
                ->addColumn('district_name', function($data){
                    return @$data->district->bn_name;
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
        $data['thanas'] = Thana::pluck('bn_name','id');
        $data['divisions'] = Division::pluck('bn_name','id');
        $data['districts'] = District::pluck('bn_name','id');
        return view($this->path('create'))->with($data);
    }

    public function store(ThanaRequest $request)
    {
        try {
            $thana = New Thana();
            $thana->create($request->all());

            \Toastr::success('Thana Created', 'Success');
            return redirect(route('thana.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Thana $thana)
    {
        //
    }

    public function edit(Thana $thana)
    {
        $data['thana'] = $thana;
        $data['thanas'] = Thana::pluck('name','id');
        $data['divisions'] = Division::pluck('bn_name','id');
        $data['districts'] = District::pluck('bn_name','id');
        return view($this->path('edit'))->with($data);
    }

    public function update(ThanaRequest $request, Thana $thana)
    {
        try {
            $thana->update($request->all());
            \Toastr::success('Thana Updated', 'Success');
            return redirect(route('thana.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Thana $thana)
    {
        $thana->deleted_by = \Auth::id();
        $thana->save();
        $thana->delete();
        return response()->json([
            'message' => 'Thana deleted'
        ]);
    }
}
