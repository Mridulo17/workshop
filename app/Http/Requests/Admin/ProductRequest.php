<?php

namespace App\Http\Requests\Admin;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LocalizedNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function withValidator(Validator $validator)
    {
       /* $messages = $validator->messages();

        foreach ($messages->all() as $message)
        {
            Toastr::error($message, trans('settings.failed'), ['timeOut' => 10000]);
        }

        return $validator->errors()->all();*/
    }

    public function rules()
    {
        $data = request()->all();
        return [
            'type_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'entry_date' => 'nullable|date_format:d-m-Y',
            'registration_number' => [
                'nullable',
                Rule::unique('products','registration_number')
                    ->ignore(@$this->product->id, 'id')
                    ->where(function ($query) {
                        $query->where('registration_number', '!=', 'ON TEST');
                    }),
            ],
            'divisional_number' => 'nullable|unique:products,divisional_number,'.@$this->product->id,
            'engine_number' => 'nullable|unique:products,engine_number,'.@$this->product->id,
            'chassis_number' => 'nullable|unique:products,chassis_number,'.@$this->product->id,
            'cylinder_number' => ['nullable',new LocalizedNumber],
            'volume' => ['nullable',new LocalizedNumber],
            'horsepower' => ['nullable',new LocalizedNumber],
            'tire_number' => ['nullable',new LocalizedNumber],
            'minimum_stock' => ['nullable',new LocalizedNumber],
            'status' => 'required',
        ];
    }

    public function attributes()
    {
        $attributes = [];
        foreach ($this->rules() as $key => $rule){
            $attributes[$key] = trans('product.'.$key);
        }
        return $attributes;
    }
}
