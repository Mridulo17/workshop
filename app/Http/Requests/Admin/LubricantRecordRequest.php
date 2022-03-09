<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LubricantRecordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'lubricants.*.mobil_oil' => 'nullable|required_without_all:lubricants.*.gear_oil,lubricants.*.brake_oil,lubricants.*.hydraulic_oil,lubricants.*.grease|numeric',
            'lubricants.*.gear_oil' => 'nullable|required_without_all:lubricants.*.mobil_oil,lubricants.*.brake_oil,lubricants.*.hydraulic_oil,lubricants.*.grease|numeric',
            'lubricants.*.brake_oil' => 'nullable|required_without_all:lubricants.*.mobil_oil,lubricants.*.gear_oil,lubricants.*.hydraulic_oil,lubricants.*.grease|numeric',
            'lubricants.*.hydraulic_oil' => 'nullable|required_without_all:lubricants.*.mobil_oil,lubricants.*.gear_oil,lubricants.*.brake_oil,lubricants.*.grease|numeric',
            'lubricants.*.grease' => 'nullable|required_without_all:lubricants.*.mobil_oil,lubricants.*.gear_oil,lubricants.*.brake_oil,lubricants.*.hydraulic_oil|numeric',
//            'substitutor_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
            'lubricants.*.substitutor_date' => 'nullable|date_format:d-m-Y',
//            'sso_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
            'lubricants.*.sso_date' => 'nullable|date_format:d-m-Y',
        ];
    }

    public function messages()
    {
        return [
            'lubricants.*.substitutor_date.date_format' => trans('common.date_format',['format' => 'dd-mm-yyyy']),
            'lubricants.*.sso_date.date_format' => trans('common.date_format',['format' => 'dd-mm-yyyy']),
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => trans('product.product'),
            'lubricants.*.mobil_oil' => trans('lubricant_record.mobil_oil'),
            'lubricants.*.gear_oil' => trans('lubricant_record.gear_oil'),
            'lubricants.*.brake_oil' => trans('lubricant_record.brake_oil'),
            'lubricants.*.hydraulic_oil' => trans('lubricant_record.hydraulic_oil'),
            'lubricants.*.grease' => trans('lubricant_record.grease'),
            'lubricants.*.substitutor_date' => trans('lubricant_record.substituter_date'),
            'lubricants.*.sso_date' => trans('lubricant_record.sso_date'),
        ];
    }
}
