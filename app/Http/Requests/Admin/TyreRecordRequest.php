<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TyreRecordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'registration_number' => 'required',
            'tyre_record_details.*.issue_date' => 'nullable|date_format:d-m-Y',
            'tyre_record_details.*.tyre_serial_number' => 'nullable',
            'tyre_record_details.*.tyre_number' => 'nullable',
            'tyre_record_details.*.tyre_size' => 'nullable',
            'tyre_record_details.*.tyre_ply' => 'nullable',
            'tyre_record_details.*.manufacturer_brand_id' => 'required',
            'tyre_record_details.*.manufacturer_country_id' => 'required',
            'tyre_record_details.*.rotation_date' => 'nullable|date_format:d-m-Y',
            'tyre_record_details.*.rotation_meter_reading' => 'nullable',
            'tyre_record_details.*.rejected_announced_date' => 'nullable|date_format:d-m-Y',
            'tyre_record_details.*.rejected_announce_meter_reading' => 'nullable',
            'tyre_record_details.*.rejected_announce_tyre_number' => 'nullable',
            'tyre_record_details.*.driver_employee_id' => 'required',
            'tyre_record_details.*.sso_so_employee_id' => 'required',
            // 'examiner_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
            // 'driver_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
            // 'sso_so_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => trans('product.product'),
            'registration_number' => trans('tyre_record.registration_number'),
            'tyre_record_details.*.issue_date' => trans('tyre_record.issue_date'),
            'tyre_record_details.*.tyre_serial_number' => trans('tyre_record.tyre_serial_number'),
            'tyre_record_details.*.tyre_number' => trans('tyre_record.tyre_number'),
            'tyre_record_details.*.tyre_size' => trans('tyre_record.tyre_size'),
            'tyre_record_details.*.tyre_ply' => trans('tyre_record.tyre_ply'),
            'tyre_record_details.*.manufacturer_brand_id' => trans('tyre_record.manufacturer_brand_id'),
            'tyre_record_details.*.manufacturer_country_id' => trans('tyre_record.manufacturer_country_id'),
            'tyre_record_details.*.rotation_date' => trans('tyre_record.rotation_date'),
            'tyre_record_details.*.rotation_meter_reading' => trans('tyre_record.rotation_meter_reading'),
            'tyre_record_details.*.rejected_announced_date' => trans('tyre_record.rejected_announced_date'),
            'tyre_record_details.*.rejected_announce_meter_reading' => trans('tyre_record.rejected_announce_meter_reading'),
            'tyre_record_details.*.rejected_announce_tyre_number' => trans('tyre_record.rejected_announce_tyre_number'),
            'tyre_record_details.*.driver_employee_id' => trans('tyre_record.driver_employee_id'),
            'tyre_record_details.*.sso_so_employee_id' => trans('tyre_record.sso_so_employee_id'),
        ];
    }
}
