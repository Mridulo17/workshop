<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DriverRecordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'driver_record_details.*.driver_employee_id' => 'required',
            'driver_record_details.*.in_date' => 'nullable|date_format:d-m-Y',
            'driver_record_details.*.in_meter_reading' => 'nullable',
            'driver_record_details.*.out_date' => 'nullable|date_format:d-m-Y',
            'driver_record_details.*.out_meter_reading' => 'nullable',
            'driver_record_details.*.sso_so_employee_id' => 'required',
//          'examiner_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
//           'driver_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
//           'sso_so_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'driver_record_details.*.in_date.date_format' => trans('common.date_format',['format' => 'dd-mm-yyyy']),
            'driver_record_details.*.out_date.date_format' => trans('common.date_format',['format' => 'dd-mm-yyyy']),
        ];
    }


    public function attributes()
    {
        return [
            'product_id' => trans('product.product'),
            'driver_record_details.*.driver_employee_id' => trans('driver_record.driver_employee_id'),
            'driver_record_details.*.in_date' => trans('driver_record.in_date'),
            'driver_record_details.*.in_meter_reading' => trans('driver_record.in_meter_reading'),
            'driver_record_details.*.out_date' => trans('driver_record.out_date'),
            'driver_record_details.*.out_meter_reading' => trans('driver_record.out_meter_reading'),
            'driver_record_details.*.sso_so_employee_id' => trans('driver_record.sso_so_employee_id'),
            'lubricants.*.sso_date' => trans('lubricant_record.sso_date'),
        ];
    }
}
