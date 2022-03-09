<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KmplLphRecordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'kmpl_lph_details.*.examiner_employee_id' => 'required',
            'kmpl_lph_details.*.examiner_designation_id' => 'required',
            'kmpl_lph_details.*.exam_date' => 'nullable|date_format:d-m-Y',
            'kmpl_lph_details.*.result_kmpl' => 'nullable',
            'kmpl_lph_details.*.result_lph' => 'nullable',
        ];
    }

    public function attributes(){
        return [
            'product_id' => trans('product.product'),
            'kmpl_lph_details.*.examiner_employee_id' => trans('kmpl_lph_record.examiner_employee_id'),
            'kmpl_lph_details.*.examiner_designation_id' => trans('kmpl_lph_record.examiner_designation_id'),
            'kmpl_lph_details.*.exam_date' => trans('kmpl_lph_record.exam_date'),
            'kmpl_lph_details.*.result_kmpl' => trans('kmpl_lph_record.result_kmpl'),
            'kmpl_lph_details.*.result_lph' => trans('kmpl_lph_record.result_lph'),
        ];
    }
}
