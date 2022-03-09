@extends('admin.layouts.pdf')

@section('title') @lang('vehicle_maintenance_order.vehicle_maintenance_order') {{ $vehicle_maintenance_order->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('vehicle_maintenance_order.vehicle_maintenance_order')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{$vehicle_maintenance_order->product->type->bn_name}} -
                {{$vehicle_maintenance_order->product->category->bn_name}} -
                {{$vehicle_maintenance_order->product->brand->bn_name}} -
                {{$vehicle_maintenance_order->product->model->bn_name}} -
                ( {{$vehicle_maintenance_order->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-center">গাড়ি ও পাম্প রক্ষণাবেক্ষণ আদেশ নং: {{$vehicle_maintenance_order->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($vehicle_maintenance_order->order_date)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
    </table>
    <br><br>
    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td style="font-size: 15px"> @lang('common.serial') </td>
            <td style="font-size: 15px">@lang('vehicle_maintenance_order.serial_number')</td>
            <td style="font-size: 15px">@lang('vehicle_maintenance_order.subject')</td>
            <td style="font-size: 15px">@lang('vehicle_maintenance_order.order_giving_employee_id')</td>
            <td style="font-size: 15px">@lang('vehicle_maintenance_order.memorandum_number')</td>
            <td style="font-size: 15px">@lang('vehicle_maintenance_order.memorandum_date')</td>
        </tr>
        @foreach($vehicle_maintenance_order->vehicleMaintenanceDetails as $key => $vehicle_maintenance_order_detail)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}.</td>
                <td class="">{{ $vehicle_maintenance_order_detail->serial_number }}</td>
                <td class="">{{ $vehicle_maintenance_order_detail->subject }}</td>
                <td>{{ $vehicle_maintenance_order_detail->employee->bn_name }} [{{ $vehicle_maintenance_order_detail->employee->old_pin }}]  [{{ $vehicle_maintenance_order_detail->employee->new_pin }}]</td>
                <td class="">{{ $vehicle_maintenance_order_detail->memorandum_number }}</td>
                <td class="">{{ $vehicle_maintenance_order_detail->memorandum_date }}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
{{--            <td class="bb-none bl-none" style="text-align: left">@lang('vehicle_maintenance_order.driver')</td>--}}

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{--{{ $vehicle_maintenance_order->product->type->bn_name }}--}} </td>

{{--            <td class="bb-none bl-none" style="text-align: right">@lang('vehicle_maintenance_order.ad_dad')</td>--}}
        </tr>
    </table>
@endsection
