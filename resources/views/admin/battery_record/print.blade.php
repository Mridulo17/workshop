@extends('admin.layouts.pdf')

@section('title') @lang('battery_record.battery_record') {{ $battery_record->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="" style=" color: #016bc6; font-size: 20px; border-radius: 15px;padding:15px;">@lang('battery_record.battery_record')</p></td>
        </tr>

    </table>
@endsection

@section('content')
    <br><br>
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{$battery_record->product->type->bn_name}} -
                {{$battery_record->product->category->bn_name}} -
                {{$battery_record->product->brand->bn_name}} -
                {{$battery_record->product->model->bn_name}} -
                ( {{$battery_record->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase">ব্যাটারি বিবরণ নং: {{$battery_record->tracking_no }}</td>
            <td class="bb-none bl-none">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($battery_record->created_at)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>

        <tr>
            <td class="bb-none bl-none text-uppercase">@lang('battery_record.battery_size_length')-{{ $battery_record->battery_size_length }} </td>
            <td class="bb-none bl-none text-uppercase">@lang('battery_record.battery_size_width')-{{ $battery_record->battery_size_width }}</td>
            <td class="bb-none bl-none text-uppercase">@lang('battery_record.battery_size_height')-{{ $battery_record->battery_size_height }}</td>
        </tr>
        <tr>
            <td class="bb-none bl-none text-uppercase">@lang('battery_record.battery_numbers')-{{ $battery_record->battery_numbers }}</td>
            <td class="bb-none bl-none text-uppercase">@lang('battery_record.battery_plate')-{{ $battery_record->battery_plate }}</td>
            <td class="bb-none bl-none text-uppercase">@lang('battery_record.battery_ampere')-{{ $battery_record->battery_ampere }}</td>
        </tr>
    </table>

    <br><br>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td style="font-size: 15px;"> @lang('common.serial') </td>
            <td style="font-size: 15px;">@lang('battery_record.issue_date')</td>
            <td style="font-size: 15px;">@lang('battery_record.battery_brand')</td>
            <td style="font-size: 15px;">@lang('battery_record.battery_number')</td>
            <td style="font-size: 15px;">@lang('battery_record.full_charge_gravity')</td>
            <td style="font-size: 15px;">@lang('battery_record.rejected_announced_date')</td>
            <td style="font-size: 15px;">@lang('battery_record.duty_driver_employee_id')</td>
            <td style="font-size: 15px;">@lang('battery_record.sso_employee_id')</td>
        </tr>
        @foreach($battery_record->batteryDetails as $key => $battery_record)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}.</td>
                <td>{{ $battery_record->driverEmployee->bn_name }} [{{ $battery_record->driverEmployee->old_pin }}]  [{{ $battery_record->driverEmployee->new_pin }}]</td>
                <td>{{ $battery_record->ssoEmployee->bn_name }} [{{ $battery_record->ssoEmployee->old_pin }}]  [{{ $battery_record->ssoEmployee->new_pin }}]</td>
                <td class="">{{ $battery_record->issue_date ? date('d-m-Y',strtotime($battery_record->issue_date)) : '' }}</td>
                <td class="">{{ $battery_record->battery_brand }}</td>
                <td class="">{{ $battery_record->battery_number }}</td>
                <td class="">{{ $battery_record->full_charge_gravity }}</td>
                <td class="">{{ $battery_record->rejected_announced_date ? date('d-m-Y',strtotime($battery_record->rejected_announced_date)) : '' }}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
{{--            <td class="bb-none bl-none" style="text-align: left">@lang('battery_record.driver')</td>--}}

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{--{{ $battery_record->product->type->bn_name }}--}} </td>

{{--            <td class="bb-none bl-none" style="text-align: right">@lang('battery_record.ad_dad')</td>--}}
        </tr>
    </table>
@endsection
