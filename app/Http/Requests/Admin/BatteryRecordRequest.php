<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BatteryRecordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'battery_records.*.battery_size_length' => 'nullable',
            'battery_records.*.battery_size_width' => 'nullable',
            'battery_records.*.battery_size_height' => 'nullable',
            'battery_records.*.battery_numbers' => 'nullable',
            'battery_records.*.battery_plate' => 'nullable',
            'battery_records.*.battery_ampere' => 'nullable',
            'battery_records.*.issue_date' => 'nullable|date_format:d-m-Y',
            'battery_records.*.battery_brand' => 'nullable',
            'battery_records.*.battery_number' => 'nullable',
            'battery_records.*.full_charge_gravity' => 'nullable',
            'battery_records.*.rejected_announced_date' => 'nullable|date_format:d-m-Y',
            'battery_records.*.duty_driver_employee_id' => 'required',
            'battery_records.*.sso_employee_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'battery_records.*.battery_size_length' => trans('battery_record.battery_size_length'),
            'battery_records.*.battery_size_width' => trans('battery_record.battery_size_width'),
            'battery_records.*.battery_size_height' => trans('battery_record.battery_size_height'),
            'battery_records.*.battery_numbers' => trans('battery_record.battery_numbers'),
            'battery_records.*.battery_plate' => trans('battery_record.battery_plate'),
            'battery_records.*.battery_ampere' => trans('battery_record.battery_ampere'),
            'battery_records.*.issue_date' => trans('battery_record.issue_date'),
            'battery_records.*.battery_brand' => trans('battery_record.battery_brand'),
            'battery_records.*.battery_number' => trans('battery_record.battery_number'),
            'battery_records.*.full_charge_gravity' => trans('battery_record.full_charge_gravity'),
            'battery_records.*.rejected_announced_date' => trans('battery_record.rejected_announced_date'),
            'battery_records.*.duty_driver_employee_id' => trans('battery_record.duty_driver_employee_id'),
            'battery_records.*.sso_employee_id' => trans('battery_record.sso_employee_id'),
        ];
    }
}
