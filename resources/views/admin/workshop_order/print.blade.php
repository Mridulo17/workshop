@extends('admin.layouts.pdf')

@section('title') @lang('workshop_order.workshop_order') {{ $workshop_order->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('workshop_order.workshop_order')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left">@lang('workshop_order.product'): {{ $workshop_order->product->bn_name }}</td>
            <td class="bb-none bl-none text-uppercase text-center">ওয়ার্কশপ অর্ডার নং: {{ $workshop_order->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($workshop_order->order_date)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
    </table>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td> @lang('common.serial') </td>
            <td> @lang('workshop_order.fault') </td>
            <td> @lang('common.remarks') </td>
        </tr>
        @foreach($workshop_order->faults as $fault)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}.</td>
                <td class="">{{ $fault->name }}.</td>
                <td class="">{{ $fault->remarks }}.</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left">@lang('workshop_order.driver')</td>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{ $workshop_order->workshop->bn_name }} </td>

            <td class="bb-none bl-none" style="text-align: right">@lang('workshop_order.ad_dad')</td>
        </tr>
    </table>
@endsection
