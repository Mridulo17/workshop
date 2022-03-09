<?php

namespace App\Http\Requests\Admin;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FireStationRequest extends FormRequest
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
            'name' => 'nullable|unique:fire_stations,name,'.@$this->fire_station->id,
            'bn_name' => 'required|unique:fire_stations,bn_name,'.@$this->fire_station->id,
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'fire_station_type_id' => 'required',
            'category' => 'required',
        ];
    }
}
