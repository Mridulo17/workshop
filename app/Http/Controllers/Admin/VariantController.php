<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VariantRequest;
use App\Interfaces\VariantInterface;
use App\Interfaces\VariantTypeInterface;
use App\Models\Variant;

class VariantController extends Controller
{
    protected $variant;

    public function __construct(VariantInterface $variant, VariantTypeInterface $variant_type)
    {
        $this->variant = $variant;
        $this->variant_type = $variant_type;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.variant.{$link}";
    }

    public function index()
    {
        if(request()->ajax()){
            return $this->variant->datatable(['variant_type']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex()
    {
        if (request()->ajax()){
            return $this->variant->deletedDatatable(['variant_type']);
        }
    }

    public function create()
    {
        $data = [
            'title' => trans('variant.create'),
            'form_action' => route('variant.store'),
            'method' => 'post',
            'included_path' => 'admin.variant.form',
            'variant_types' => $this->variant_type->pluck(),
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function store(VariantRequest $request)
    {
        return $this->variant->create($request);
    }

    public function show(Variant $variant)
    {
        //
    }

    public function edit(Variant $variant)
    {
        $data = [
            'title' => trans('variant.edit'),
            'form_action' => route('variant.update',$variant->id),
            'method' => 'patch',
            'model' => $variant,
            'included_path' => 'admin.variant.form',
            'variant_types' => $this->variant_type->pluck(),
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function update(VariantRequest $request, Variant $variant)
    {
        return $this->variant->update($variant->id,$request);
    }

    public function destroy(Variant $variant)
    {
        return $this->variant->delete($variant->id);
    }

    public function restore($id){
        return $this->variant->restore($id);
    }

    public function forceDelete($id){
        return $this->variant->forceDelete($id);
    }

}
