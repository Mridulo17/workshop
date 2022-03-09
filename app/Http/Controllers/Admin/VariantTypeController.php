<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VariantTypeRequest;
use App\Interfaces\VariantTypeInterface;
use App\Models\VariantType;

class VariantTypeController extends Controller
{
    protected $variant_type;

    public function __construct(VariantTypeInterface $variant_type)
    {
        $this->variant_type = $variant_type;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.variant_type.{$link}";
    }

    public function index()
    {
        if(request()->ajax()){
            return $this->variant_type->datatable();
        }
        return view($this->path('index'));
    }

    public function deletedListIndex()
    {
        if (request()->ajax()){
            return $this->variant_type->deletedDatatable();
        }
    }

    public function create()
    {
        $data = [
            'title' => trans('variant_type.create'),
            'form_action' => route('variant_type.store'),
            'method' => 'post',
            'included_path' => 'admin.variant_type.form',
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function store(VariantTypeRequest $request)
    {
        return $this->variant_type->create($request);
    }

    public function show(VariantType $variant_type)
    {
        //
    }

    public function edit(VariantType $variant_type)
    {
        $data = [
            'title' => trans('variant_type.edit'),
            'form_action' => route('variant_type.update',$variant_type->id),
            'method' => 'patch',
            'model' => $variant_type,
            'included_path' => 'admin.variant_type.form',
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function update(VariantTypeRequest $request, VariantType $variant_type)
    {
        return $this->variant_type->update($variant_type->id,$request);
    }

    public function destroy(VariantType $variant_type)
    {
        return $this->variant_type->delete($variant_type->id);
    }

    public function restore($id){
        return $this->variant_type->restore($id);
    }

    public function forceDelete($id){
        return $this->variant_type->forceDelete($id);
    }

}
