<?php

namespace App\Http\Requests\Admin;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModelRequest extends FormRequest
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
            'name' => 'nullable|'.$this->modelNameUnique(request()->all()),
            'bn_name' => 'required|'.$this->modelBnNameUnique(request()->all()),
            'brand_id' => 'required',
        ];
    }

    private function modelNameUnique($data)
    {
        $rule = Rule::unique('models','name')->ignore(@$this->model->id, 'id');
//        $rule->where('brand_id',$data['brand_id'])->where('name',$data['name']);

        return $rule;
    }

    private function modelBnNameUnique($data)
    {
        $rule = Rule::unique('models','bn_name')->ignore(@$this->model->id, 'id');
//        $rule->where('brand_id',$data['brand_id'])->where('bn_name',$data['bn_name']);

        return $rule;
    }
}
