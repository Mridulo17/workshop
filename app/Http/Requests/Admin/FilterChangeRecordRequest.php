<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilterChangeRecordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'filter_change_details.*.mobil_filter' => 'nullable|required_without_all:filter_change_details.*.diesel_filter,filter_change_details.*.air_filter|numeric',
            'filter_change_details.*.diesel_filter' => 'nullable|required_without_all:filter_change_details.*.mobil_filter,filter_change_details.*.air_filter|numeric',
            'filter_change_details.*.air_filter' => 'nullable|required_without_all:filter_change_details.*.mobil_filter,filter_change_details.*.diesel_filter|numeric',
            'filter_change_details.*.change_date' => 'nullable|date_format:d-m-Y',
//            'substitutor_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
            'filter_change_details.*.substitutor_date' => 'nullable|date_format:d-m-Y',
//            'sso_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
            'filter_change_details.*.sso_date' => 'nullable|date_format:d-m-Y',
        ];
    }



    public function attributes()
    {
        return [
            'product_id' => trans('product.product'),
            'filter_change_details.*.mobil_filter' => trans('filter_change_record.mobil_filter'),
            'filter_change_details.*.diesel_filter' => trans('filter_change_record.diesel_filter'),
            'filter_change_details.*.air_filter' => trans('filter_change_record.air_filter'),
            'filter_change_details.*.change_date' => trans('filter_change_record.change_date'),
            'filter_change_details.*.substitutor_date' => trans('filter_change_record.substitutor_date'),
            'filter_change_details.*.sso_date' => trans('filter_change_record.sso_date'),
        ];
    }
}
