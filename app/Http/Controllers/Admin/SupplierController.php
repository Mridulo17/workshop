<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SupplierRequest;
use App\Interfaces\SupplierInterface;
use App\Models\District;
use App\Models\Division;
use App\Models\Supplier;
use App\Models\Thana;

class SupplierController extends Controller
{
    protected $supplier;

    public function __construct(SupplierInterface $supplier)
    {
        $this->supplier = $supplier;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.supplier.{$link}";
    }

    public function index()
    {
        if(request()->ajax()){
            $datatable = $this->supplier->datatable([],'false');

            return $datatable->make(true);
        }else{
            return view($this->path('index'));
        }
    }

    public function deletedListIndex()
    {
        if (request()->ajax()){
            $datatable = $this->supplier->deletedDatatable([],'false');

            return $datatable->make(true);
        }
    }

    public function create()
    {
        $data['supplier'] = '';
        $data['divisions'] = Division::query()->pluck('bn_name','id');
        $data['districts'] = [];
        $data['thanas'] = [];
        return view($this->path('create'))->with($data);
    }

    public function store(SupplierRequest $request)
    {
        $data = $request;
        return $this->supplier->create($data);
    }

    public function show(Supplier $supplier)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        $data['supplier'] = $supplier;
        $data['divisions'] = Division::query()->pluck('bn_name','id');
        $data['districts'] = District::query()->where('division_id',$supplier->division_id)->pluck('bn_name','id');
        $data['thanas'] = Thana::query()->where('district_id',$supplier->district_id)->pluck('bn_name','id');
        return view($this->path('edit'))->with($data);
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $data = $request;
        return $this->supplier->update($supplier->id,$data);
    }

    public function destroy(Supplier $supplier)
    {
        return $this->supplier->delete($supplier->id);
    }

    public function restore($id){
        return $this->supplier->restore($id);
    }

    public function forceDelete($id){
        return $this->supplier->forceDelete($id);
    }
}
