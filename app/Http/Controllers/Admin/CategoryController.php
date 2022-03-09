<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Interfaces\CategoryInterface;
use App\Interfaces\TypeInterface;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $category;
    protected $type;

    public function __construct(CategoryInterface $category, TypeInterface $type){
        $this->category = $category;
        $this->type = $type;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.category.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->category->datatable(['type']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->category->deletedDatatable(['type']);
        }
    }

    public function create(){
        $data = [
            'title' => trans('common.create',['model' => trans('category.category')]),
            'type_id' => request('parent_id'),
            'form_action' => route('category.store'),
            'method' => 'post',
            'included_path' => 'admin.category.form',
            'types' => $this->type->pluck(),
        ];

        return ModalHelper::content($data);
    }

    public function store(CategoryRequest $request){
        $category =  $this->category->create($request)->getData()->data;
        $categories =  $this->category->pluck(['type_id'=> $category->type_id]);

        $data = [
            'categories' => $categories,
            'category' => $category,
            'message' => trans('common.created',['model' => trans('category.category')]),
        ];

        return $data;
    }

    public function show(Category $category){
        //
    }

    public function edit(Category $category){
        $data = [
            'title' => trans('common.edit',['model' => trans('category.category')]),
            'form_action' => route('category.update',$category->id),
            'method' => 'patch',
            'model' => $category,
            'included_path' => 'admin.category.form',
            'types' => $this->type->pluck(),
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function update(CategoryRequest $request, Category $category){
        return $this->category->update($category->id,$request);
    }

    public function destroy(Category $category){
        return $this->category->delete($category->id);
    }

    public function restore($id){
        return $this->category->restore($id);
    }

    public function forceDelete($id){
        return $this->category->forceDelete($id);
    }
}
