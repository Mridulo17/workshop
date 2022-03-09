<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UnitConversionRequest;
use App\Interfaces\ProductPartInterface;
use App\Interfaces\UnitConversionInterface;
use App\Interfaces\UnitInterface;
use App\Models\UnitConversion;

class UnitConversionController extends Controller
{
    protected $unit_conversion;
    protected $unit;
    protected $product_part;

    public function __construct(UnitConversionInterface $unit_conversion, UnitInterface $unit, ProductPartInterface $product_part){
        $this->unit_conversion = $unit_conversion;
        $this->unit = $unit;
        $this->product_part = $product_part;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.unit_conversion.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->unit_conversion->datatable();
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->unit_conversion->deletedDatatable();
        }
    }

    public function create(){
        $data['unit_conversions'] = $this->unit_conversion->pluck();
        $data['units'] = $this->unit->pluck();
        $data['product_parts'] = $this->product_part->pluck();
        return view($this->path('create'))->with($data);
    }

    public function store(UnitConversionRequest $request){
        return $this->unit_conversion->create($request);
    }

    public function show(UnitConversion $unit_conversion){
        //
    }

    public function edit(UnitConversion $unit_conversion){
        $data['unit_conversion'] = $unit_conversion;
        $data['unit_conversions'] = $this->unit_conversion->pluck();
        $data['units'] = $this->unit->pluck();
        $data['product_parts'] = $this->product_part->pluck();
        return view($this->path('edit'))->with($data);
    }

    public function update(UnitConversionRequest $request, UnitConversion $unit_conversion){
        return $this->unit_conversion->update($unit_conversion->id,$request);
    }

    public function destroy(UnitConversion $unit_conversion){
        return $this->unit_conversion->delete($unit_conversion->id);
    }

    public function restore($id){
        return $this->unit_conversion->restore($id);
    }

    public function forceDelete($id){
        return $this->unit_conversion->forceDelete($id);
    }

}
