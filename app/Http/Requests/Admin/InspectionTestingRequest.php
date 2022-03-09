<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InspectionTestingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'inspection_testing_details.*.visitor_employee_id' => 'required',
            'inspection_testing_details.*.visitor_designation_id' => 'required',
            'inspection_testing_details.*.visitor_helper_employee_id' => 'required',
            'inspection_testing_details.*.visitor_helper_designation_id' => 'required',
            'inspection_testing_details.*.fill_inspection_book' => 'nullable',
            'inspection_testing_details.*.fill_inspection_seat_number' => 'nullable',
            'inspection_testing_details.*.inspection_short_remarks' => 'nullable',
//          'examiner_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
//           'driver_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
//           'sso_so_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
        ];
    }

    public function attributes(){
        return [
            'product_id' => trans('product.product'),
            'inspection_testing_details.*.visitor_employee_id' => trans('inspection_testing.visitor_employee_id'),
            'inspection_testing_details.*.visitor_designation_id' => trans('inspection_testing.visitor_designation_id'),
            'inspection_testing_details.*.visitor_helper_employee_id' => trans('inspection_testing.visitor_helper_employee_id'),
            'inspection_testing_details.*.visitor_helper_designation_id' => trans('inspection_testing.visitor_helper_designation_id'),
            'inspection_testing_details.*.fill_inspection_book' => trans('inspection_testing.fill_inspection_book'),
            'inspection_testing_details.*.fill_inspection_seat_number' => trans('inspection_testing.fill_inspection_seat_number'),
            'inspection_testing_details.*.inspection_short_remarks' => trans('inspection_testing.inspection_short_remarks'),
        ];
    }
}
