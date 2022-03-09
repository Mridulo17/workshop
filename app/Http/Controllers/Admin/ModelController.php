<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Requests\Admin\ModelRequest;
use App\Interfaces\BrandInterface;
use App\Interfaces\ModelInterface;
use App\Models\Model;
use Illuminate\Routing\Controller;

class ModelController extends Controller
{
    protected $model;
    protected $brand;

    public function __construct(ModelInterface $model, BrandInterface $brand){
        $this->model = $model;
        $this->brand = $brand;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.model.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->model->datatable(['brand']);
        }else{
            return view($this->path('index'));
        }
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->model->deletedDatatable(['brand']);
        }
    }

    public function create(){
        $data['brands'] = $this->brand->pluck();
        $data['models'] = $this->model->pluck();

        return view($this->path('create'))->with($data);
    }

    public function store(ModelRequest $request){
        return $this->model->create($request);
    }

    public function show(Model $model){
        //
    }

    public function edit(Model $model){
        $data['model'] = $model;
        $data['brands'] = $this->brand->pluck();
        $data['models'] = $this->model->pluck();
        return view($this->path('edit'))->with($data);
    }

    public function update(ModelRequest $request, Model $model){
        return $this->model->update($model->id,$request);
    }

    public function destroy(Model $model){
        return $this->model->delete($model->id);
    }

    public function restore($id){
        return $this->model->restore($id);
    }

    public function forceDelete($id){
        return $this->model->forceDelete($id);
    }

    public function createModal(){
        $data = [
            'title' => trans('common.create',['model' => trans('model.model')]),
            'brand_id' => request('parent_id'),
            'form_action' => route('model_store_from_modal'),
            'method' => 'post',
            'included_path' => 'admin.model.form',
            'brands' => $this->brand->pluck(),
        ];
        $modal_content = ModalHelper::content($data);
        return $modal_content;
    }

    public function storeFromModal(ModelRequest $request){
        $model =  $this->model->create($request)->getData()->data;
        $models =  $this->model->pluck(['brand_id'=> $model->brand_id]);

        $data = [
            'models' => $models,
            'model' => $model,
            'message' => trans('common.created',['model' => trans('model.model')]),
        ];

        return $data;

    }

}
