<?php

namespace App\Http\Requests\Admin;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LocalizedNumber;
use Illuminate\Http\Request;

class StockReceiveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function withValidator(Validator $validator)
    {
        $messages = $validator->messages();

        foreach ($messages->all() as $message)
        {
            Toastr::error($message, trans('settings.failed'), ['timeOut' => 10000]);
        }

        return $validator->errors()->all();
    }

    public function rules( Request $request)
    {
        return [
            'workshop_id' => 'required',
            'fire_station_id' => 'required',
            'supplier_id' => 'required',
            'received_date' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'workshop_id' => trans('stock_receive.workshop_id'),
            'fire_station_id' => trans('stock_receive.fire_station_id'),
            'supplier_id' => trans('stock_receive.supplier_id'),
            'received_date' => trans('stock_receive.received_date'),
        ];
    }
}
