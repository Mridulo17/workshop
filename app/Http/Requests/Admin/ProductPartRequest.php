<?php

namespace App\Http\Requests\Admin;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LocalizedNumber;
use Illuminate\Http\Request;

class ProductPartRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function withValidator(Validator $validator)
    {
        $messages = $validator->messages();

        foreach ($messages->all() as $message)
        {
            Toastr::error($message, trans('settings.failed'), ['timeOut' => 10000]);
        }

        return $validator->errors()->all();
    }

    public function rules(Request $request)
    {
        return [
            'brand_id' => 'required',
            'model_id' => 'required',
            /*'name' => 'nullable|unique:product_parts,name,'.@$this->product_part->id,
            'bn_name' => 'required|unique:product_parts,bn_name,'.@$this->product_part->id,
            'sku' => 'required|unique:product_parts,sku,'.@$this->product_part->id,*/
            'registration_number' => 'required|unique:product_parts,registration_number,'.@$this->product_part->id,
            'material' => 'required',
            'material_type' => 'required',
            'parts' => 'required',
            'products.*' => 'required_if:parts,"specific"',
            'weight' => 'required',
//            'minimum_stock' => 'required',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,svg,webp,bmp|max:4096',
            'variant_id.*' => 'required',
            'variant_type_id.*' => 'required',
            'status' => 'required',
        ];
    }
}
