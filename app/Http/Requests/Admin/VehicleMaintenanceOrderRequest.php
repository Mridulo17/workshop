<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VehicleMaintenanceOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required',
            'vehicle_maintenance_orders.*.serial_number' => 'nullable',
            'vehicle_maintenance_orders.*.subject' => 'nullable',
            'vehicle_maintenance_orders.*.order_giving_employee_id' => 'required',
            'vehicle_maintenance_orders.*.memorandum_number' => 'nullable',
            'vehicle_maintenance_orders.*.memorandum_date' => 'nullable|date_format:d-m-Y',
//          'examiner_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
//           'driver_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
//           'sso_so_signature' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:1024',
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => trans('product.product'),
            'vehicle_maintenance_orders.*.serial_number' => trans('vehicle_maintenance_order.serial_number'),
            'vehicle_maintenance_orders.*.subject' => trans('vehicle_maintenance_order.subject'),
            'vehicle_maintenance_orders.*.order_giving_employee_id' => trans('vehicle_maintenance_order.order_giving_employee_id'),
            'vehicle_maintenance_orders.*.memorandum_number' => trans('vehicle_maintenance_order.memorandum_number'),
            'vehicle_maintenance_orders.*.memorandum_date' => trans('vehicle_maintenance_order.memorandum_date'),
        ];
    }
}
