@extends('admin.layouts.pdf')

@section('title') @lang('monthly_transit.monthly_transit') {{ $monthly_transit->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('monthly_transit.monthly_transit')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{$monthly_transit->product->type->bn_name}} -
                {{$monthly_transit->product->category->bn_name}} -
                {{$monthly_transit->product->brand->bn_name}} -
                {{$monthly_transit->product->model->bn_name}} -
                ( {{$monthly_transit->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-center">মাসিক চলাচলের বিবরণ নং: {{$monthly_transit->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($monthly_transit->created_at)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
    </table>

    <br><br>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td>@lang('common.serial') </td>
            <td>@lang('monthly_transit.month')</td>
            <td>@lang('monthly_transit.kmpl_lph_per_month')</td>
            <td>@lang('monthly_transit.fuel_cost')</td>
            <td>@lang('monthly_transit.lubricant_cost')</td>
            <td>@lang('monthly_transit.kmpl_lph_per_liter')</td>
            <td>@lang('monthly_transit.sso_employee_id')</td>
        </tr>
        @foreach($monthly_transit->monthlyTransitDetails as $key => $monthly_transit_detail)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}.</td>
                <td class="">{{ \App\Models\MonthlyTransit::findMonth($monthly_transit_detail->month) }}</td>
                <td class="">{{ $monthly_transit_detail->kmpl_lph_per_month }}</td>
                <td class="">{{ $monthly_transit_detail->fuel_cost }}</td>
                <td class="">{{ $monthly_transit_detail->lubricant_cost }}</td>
                <td class="">{{ $monthly_transit_detail->kmpl_lph_per_liter }}</td>
                <td>{{ $monthly_transit_detail->employee->bn_name }} [{{ $monthly_transit_detail->employee->old_pin }}]  [{{ $monthly_transit_detail->employee->new_pin }}]</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{--{{ $monthly_transit->product->type->bn_name }}--}} </td>

{{--            <td class="bb-none bl-none" style="text-align: right">@lang('monthly_transit.ad_dad')</td>--}}
        </tr>
    </table>
@endsection
