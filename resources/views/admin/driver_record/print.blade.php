@extends('admin.layouts.pdf')

@section('title') @lang('driver_record.driver_record') {{ $driver_record->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('driver_record.driver_record')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{--                @lang('product.product'):--}}
                {{$driver_record->product->type->bn_name}} -
                {{$driver_record->product->category->bn_name}} -
                {{$driver_record->product->brand->bn_name}} -
                {{$driver_record->product->model->bn_name}} -
                ( {{$driver_record->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-left">চালকের  রেকর্ড নং: {{$driver_record->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($driver_record->order_date)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
    </table>

    <table style="border: 2px solid #000; height: 900px;" class="text-center">
        <tr>
            <td>@lang('common.serial')</td>
            <td>@lang('driver_record.driver_employee_id')</td>
            <td>@lang('driver_record.in_date')</td>
            <td>@lang('driver_record.in_meter_reading')</td>
            <td>@lang('driver_record.out_date')</td>
            <td>@lang('driver_record.out_meter_reading')</td>
            <td>@lang('driver_record.sso_so_employee_id')</td>
        </tr>
            @foreach($driver_record->driverRecordDetails as $key => $driverRecordDetail)
                <tr>
                    <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}</td>
                    <td class="">{{ $driverRecordDetail->driverEmployee->bn_name }}</td>
                    <td class="">{{ $driverRecordDetail->in_date ? date('d-m-Y',strtotime($driverRecordDetail->in_date)) : '' }}</td>
                    <td class="">{{ $driverRecordDetail->in_meter_reading }}</td>
                    <td class="">{{ $driverRecordDetail->out_date ? date('d-m-Y',strtotime($driverRecordDetail->out_date)) : '' }}</td>
                    <td class="">{{ $driverRecordDetail->out_meter_reading }}</td>
                    <td class="">{{ $driverRecordDetail->ssoSoEmployee->bn_name }}</td>
                </tr>
            @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left">@lang('driver_record.driver')</td>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{ $driver_record->product->type->bn_name }} </td>

            <td class="bb-none bl-none" style="text-align: right">@lang('driver_record.ad_dad')</td>
        </tr>
    </table>
@endsection
