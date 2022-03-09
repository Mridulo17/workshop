@extends('admin.layouts.pdf')

@section('title') @lang('inspection_report.inspection_report') {{ $inspection_report->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('inspection_report.inspection_report')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left">@lang('inspection_report.serial_number'): {{ $inspection_report->serial_number }}</td>
            <td class="bb-none bl-none text-uppercase text-center">পরিদর্শন প্রতিবেদন নং: {{ $inspection_report->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($inspection_report->order_date)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
        <tr style="border: 2px solid #fff;">
            <td class="bb-none bl-none text-uppercase text-left">
                @lang('inspection_report.workshop_order_number') : {{ $inspection_report->workshopOrder->tracking_no }}
            </td>
        </tr>
    </table>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td>#</td>
            <td> @lang('workshop_order.fault')</td>
            <td> @lang('workshop_order.product_name')</td>
            <td> @lang('workshop_order.repair_work')</td>
            <td> @lang('common.amount')</td>
            <td> @lang('common.remarks')</td>
        </tr>
        @foreach($inspection_report->demands as $demand)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}</td>
                <td class="">{{ $demand->fault }}</td>
                <td class="">{{ $demand->productPart->tracking_no }}</td>
                <td class="">{{ $demand->repair_work }}</td>
                <td class="">{{ $demand->amount }}</td>
                <td class="">{{ $demand->remarks }}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left">@lang('inspection_report.driver')</td>

{{--            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{ $inspection_report->workshop->bn_name }} </td>--}}

            <td class="bb-none bl-none" style="text-align: right">@lang('inspection_report.ad_dad')</td>
        </tr>
    </table>
@endsection
