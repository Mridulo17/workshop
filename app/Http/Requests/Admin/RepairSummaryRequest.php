<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RepairSummaryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'job_card_number' => 'nullable',
            'in_date' => 'nullable|date_format:d-m-Y',
            'out_date' => 'nullable|date_format:d-m-Y',
            'in_mileage' => 'nullable',
            'out_mileage' => 'nullable',
            'workshop_employee_signature' => 'nullable',
            'repair_summary_details.*.repair_details' => 'required',
            'repair_summary_details.*.quantity' => 'nullable',

        ];
    }
    public function attributes()
    {
        return [
            'product_id' => trans('product.product'),
            'job_card_number' => trans('repair_summary.job_card_number'),
            'in_date' => trans('repair_summary.in_date'),
            'out_date' => trans('repair_summary.out_date'),
            'in_mileage' => trans('repair_summary.in_mileage'),
            'out_mileage' => trans('repair_summary.out_mileage'),
            'workshop_employee_signature' => trans('repair_summary.workshop_employee_signature'),
            'repair_summary_details.*.repair_details' => trans('repair_summary.repair_details'),
            'repair_summary_details.*.quantity' => trans('repair_summary.quantity'),
        ];
    }
}
