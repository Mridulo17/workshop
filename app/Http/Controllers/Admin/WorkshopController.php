<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkshopRequest;
use App\Interfaces\WorkshopInterface;
use App\Models\Division;
use App\Models\Workshop;

class WorkshopController extends Controller
{
    protected $workshop;

    public function __construct(WorkshopInterface $workshop){
        $this->workshop = $workshop;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.workshop.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->workshop->datatable(['division']);
        }else{
            return view($this->path('index'));
        }
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->workshop->deletedDatatable(['division']);
        }
    }

    public function create(){
        $data = [
            'divisions' => Division::query()->pluck('bn_name','id'),
            'title' => trans('common.create',['model' => trans('workshop.workshop')]),
            'form_action' => route('workshop.store'),
            'method' => 'post',
            'included_path' => 'admin.workshop.form',
        ];

        return ModalHelper::content($data);
    }

    public function store(WorkshopRequest $request){
        return $this->workshop->create($request);
    }

    public function show(Workshop $workshop){
        //
    }

    public function edit(Workshop $workshop){
        $data = [
            'divisions' => Division::query()->pluck('bn_name','id'),
            'title' => trans('common.edit',['model' => trans('workshop.workshop')]),
            'form_action' => route('workshop.update',$workshop->id),
            'method' => 'patch',
            'model' => $workshop,
            'included_path' => 'admin.workshop.form',
        ];

        return ModalHelper::content($data);
    }

    public function update(WorkshopRequest $request, Workshop $workshop){
        return $this->workshop->update($workshop->id,$request);
    }

    public function destroy(Workshop $workshop){
        return $this->workshop->delete($workshop->id);
    }

    public function restore($id){
        return $this->workshop->restore($id);
    }

    public function forceDelete($id){
        return $this->workshop->forceDelete($id);
    }
}
