<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypeRequest;
use App\Interfaces\TypeInterface;
use App\Models\Type;

class TypeController extends Controller
{
    protected $type;

    public function __construct(TypeInterface $type){
        $this->type = $type;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.type.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->type->datatable();
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->type->deletedDatatable();
        }
    }

    public function create(){
        $data = [
            'title' => trans('common.create',['model' => trans('type.type')]),
            'form_action' => route('type.store'),
            'method' => 'post',
            'included_path' => 'admin.type.form',
        ];

        return ModalHelper::content($data);
    }

    public function store(TypeRequest $request){
        return $this->type->create($request);
    }

    public function show(Type $type){
        //
    }

    public function edit(Type $type){
        $data = [
            'title' => trans('common.edit',['model' => trans('type.type')]),
            'form_action' => route('type.update',$type->id),
            'method' => 'patch',
            'model' => $type,
            'included_path' => 'admin.type.form',
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function update(TypeRequest $request, Type $type){
        return $this->type->update($type->id,$request);
    }

    public function destroy(Type $type){
        return $this->type->delete($type->id);
    }

    public function restore($id){
        return $this->type->restore($id);
    }

    public function forceDelete($id){
        return $this->type->forceDelete($id);
    }
}
