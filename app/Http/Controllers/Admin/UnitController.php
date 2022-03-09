<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UnitRequest;
use App\Interfaces\UnitInterface;
use App\Models\Unit;

class UnitController extends Controller
{
    protected $unit;

    public function __construct(UnitInterface $unit){
        $this->unit = $unit;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.unit.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->unit->datatable();
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->unit->deletedDatatable();
        }
    }

    public function create(){
        $data = [
            'title' => trans('common.create',['model' => trans('unit.unit')]),
            'form_action' => route('unit.store'),
            'method' => 'post',
            'included_path' => 'admin.unit.form',
        ];

        return ModalHelper::content($data);
    }

    public function store(UnitRequest $request){
        return $this->unit->create($request);
    }

    public function show(Unit $unit){
        //
    }

    public function edit(Unit $unit){
        $data = [
            'title' => trans('common.edit',['model' => trans('unit.unit')]),
            'form_action' => route('unit.update',$unit->id),
            'method' => 'patch',
            'model' => $unit,
            'included_path' => 'admin.unit.form',
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function update(UnitRequest $request, Unit $unit){
        return $this->unit->update($unit->id,$request);
    }

    public function destroy(Unit $unit){
        return $this->unit->delete($unit->id);
    }

    public function restore($id){
        return $this->unit->restore($id);
    }

    public function forceDelete($id){
        return $this->unit->forceDelete($id);
    }

}
