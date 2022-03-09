<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VehicleTransferRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'vehicle_transfers.*.order_designation_id' => 'required',
            'vehicle_transfers.*.order_number' => 'nullable',
            'vehicle_transfers.*.order_date' => 'nullable|date_format:d-m-Y',
            'vehicle_transfers.*.from_employee_id' => 'required',
            'vehicle_transfers.*.from_employee_designation_id' => 'required',
            'vehicle_transfers.*.from_fire_station_id' => 'required',
            'vehicle_transfers.*.to_employee_id' => 'required',
            'vehicle_transfers.*.to_employee_designation_id' => 'required',
            'vehicle_transfers.*.to_fire_station_id' => 'required',
            'vehicle_transfers.*.transfer_date' => 'nullable|date_format:d-m-Y',
//          'from_employee_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
//          'to_employee_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
        ];
    }

    public function attributes()
    {
        return [
            'vehicle_transfers.*.order_designation_id' => trans('vehicle_transfer.order_designation_id'),
            'vehicle_transfers.*.order_number' => trans('vehicle_transfer.order_number'),
            'vehicle_transfers.*.order_date' => trans('vehicle_transfer.order_date'),
            'vehicle_transfers.*.from_employee_id' => trans('vehicle_transfer.from_employee_id'),
            'vehicle_transfers.*.from_employee_designation_id' => trans('vehicle_transfer.from_employee_designation_id'),
            'vehicle_transfers.*.from_fire_station_id' => trans('vehicle_transfer.from_fire_station_id'),
            'vehicle_transfers.*.to_employee_id' => trans('vehicle_transfer.to_employee_id'),
            'vehicle_transfers.*.to_employee_designation_id' => trans('vehicle_transfer.to_employee_designation_id'),
            'vehicle_transfers.*.to_fire_station_id' => trans('vehicle_transfer.to_fire_station_id'),
            'vehicle_transfers.*.transfer_date' => trans('vehicle_transfer.transfer_date'),
//            'from_employee_signature' => 'মবিল অয়েল (মাইল মিটার)',
//            'to_employee_signature' => 'মবিল অয়েল (মাইল মিটার)',

        ];
    }
}
