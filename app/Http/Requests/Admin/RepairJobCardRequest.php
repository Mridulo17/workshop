<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RepairJobCardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'inspection_report_id' => 'required',
            'repair_job_cards.*.in_date' => 'nullable|date_format:d-m-Y',
            'repair_job_cards.*.out_date' => 'nullable|date_format:d-m-Y',
            'repair_job_cards.*.amount' => 'nullable',
            'repair_job_cards.*.receipt_place' => 'nullable',
            'repair_job_cards.*.unit' => 'nullable',
            'repair_job_cards.*.total' => 'nullable',
            'repair_job_cards.*.manpower_number_type' => 'nullable',
            'repair_job_cards.*.total_manpower_cost' => 'nullable',
            'repair_job_cards.*.total_cost' => 'nullable',
            'repair_job_cards.*.comment' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'inspection_report_id' => trans('repair_job_card.inspection_report_id'),
            'repair_job_cards.*.in_date' => trans('repair_job_card.in_date'),
            'repair_job_cards.*.out_date' => trans('repair_job_card.out_date'),
            'repair_job_cards.*.amount' => trans('repair_job_card.amount'),
            'repair_job_cards.*.receipt_place' => trans('repair_job_card.receipt_place'),
            'repair_job_cards.*.unit' => trans('repair_job_card.unit'),
            'repair_job_cards.*.total' => trans('repair_job_card.total'),
            'repair_job_cards.*.manpower_number_type' => trans('repair_job_card.manpower_number_type'),
            'repair_job_cards.*.total_manpower_cost' => trans('repair_job_card.total_manpower_cost'),
            'repair_job_cards.*.total_cost' => trans('repair_job_card.total_cost'),
            'repair_job_cards.*.comment' => trans('repair_job_card.comment'),
        ];
    }
}
