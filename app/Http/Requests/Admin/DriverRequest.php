<?php

namespace App\Http\Requests\Admin;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DriverRequest extends FormRequest
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
        if ($request->method() == 'POST'){
            return [
                'employee_id' => 'required|integer',
            ];
        } else if ($request->method() == 'PATCH') {
            return [
                'employee_id' => 'required|integer',
            ];
        }
    }
}
