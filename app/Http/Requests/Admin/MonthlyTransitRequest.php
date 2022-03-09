<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyTransitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'monthly_transit_details.*.months' => 'nullable',
            'monthly_transit_details.*.kmpl_lph_per_month' => 'nullable',
            'monthly_transit_details.*.fuel_cost' => 'nullable',
            'monthly_transit_details.*.lubricant_cost' => 'nullable',
            'monthly_transit_details.*.kmpl_lph_per_liter' => 'nullable',
            'monthly_transit_details.*.sso_employee_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => trans('product.product'),
            'monthly_transit_details.*.months' => trans('monthly_transit.months'),
            'monthly_transit_details.*.kmpl_lph_per_month' => trans('monthly_transit.kmpl_lph_per_month'),
            'monthly_transit_details.*.fuel_cost' => trans('monthly_transit.fuel_cost'),
            'monthly_transit_details.*.lubricant_cost' => trans('monthly_transit.lubricant_cost'),
            'monthly_transit_details.*.kmpl_lph_per_liter' => trans('monthly_transit.kmpl_lph_per_liter'),
            'monthly_transit_details.*.sso_employee_id' => trans('monthly_transit.sso_employee_id'),
        ];
    }
}
