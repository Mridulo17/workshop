<?php

namespace App\Http\Requests\Admin;

use App\Models\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => 'nullable|string',
            'bn_name' => 'required',
            'designation_id' => 'nullable|integer',
            'fire_station_id' => 'nullable|integer',
            'old_pin' => 'required|string|min:4|max:8|unique:employees,old_pin,'.@$this->employee->id,
            'new_pin' => 'nullable|string|min:4|max:8|unique:employees,new_pin,'.@$this->employee->id,
            'religion' => 'nullable|in:'.implode(',',array_keys(Employee::religions())),
            'gender' => 'nullable|in:'.implode(',',array_keys(Employee::genders())),
            'id_card' => 'nullable|unique:employees,id_card,'.@$this->employee->id,
            'nid' => 'nullable|unique:employees,nid,'.@$this->employee->id,
            'birth_date' => 'nullable|date_format:d-m-Y',
            'profile_picture' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:2024',
            'signature' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:1024',
            'mobile' => 'nullable|unique:employees,mobile,'.@$this->employee->id,
            'email' => 'nullable|email|unique:employees,email,'.@$this->employee->id,
        ];
    }
}
