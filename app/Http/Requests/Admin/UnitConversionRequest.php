<?php

namespace App\Http\Requests\Admin;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UnitConversionRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'nullable|unique:unit_conversions,name,'.@$this->unit_conversion->id,
            'bn_name' => 'nullable|unique:unit_conversions,bn_name,'.@$this->unit_conversion->id,
            'product_part_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'conversion_rate' => 'required|numeric',
        ];
    }
}
