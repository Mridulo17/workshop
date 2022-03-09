@extends('admin.layouts.pdf')

@section('title') @lang('inspection_testing.inspection_testing') {{ $inspection_testing->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('inspection_testing.inspection_testing')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{--                @lang('product.product'):--}}
                {{$inspection_testing->product->type->bn_name}} -
                {{$inspection_testing->product->category->bn_name}} -
                {{$inspection_testing->product->brand->bn_name}} -
                {{$inspection_testing->product->model->bn_name}} -
                ( {{$inspection_testing->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-center">পরিদরশন/পরীক্ষণ নং: {{$inspection_testing->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($inspection_testing->order_date)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
    </table>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td> @lang('common.serial') </td>
            <td>@lang('inspection_testing.visitor_employee_id')</td>
            <td>@lang('inspection_testing.visitor_designation_id')</td>
            <td>@lang('inspection_testing.visitor_helper_employee_id')</td>
            <td>@lang('inspection_testing.visitor_helper_designation_id')</td>
            <td>@lang('inspection_testing.fill_inspection_book')</td>
            <td>@lang('inspection_testing.fill_inspection_seat_number')</td>
            <td>@lang('inspection_testing.inspection_short_remarks')</td>
        </tr>
        @foreach($inspection_testing->inspectionTestingDetails as $key => $inspection_testing)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}.</td>
                <td>{{ $inspection_testing->visitorEmployee->bn_name }} [{{ $inspection_testing->visitorEmployee->old_pin }}]  [{{ $inspection_testing->visitorEmployee->new_pin }}]</td>
                <td>{{ $inspection_testing->visitorDesignation->bn_name }} </td>
                <td>{{ $inspection_testing->visitorhelperEmployee->bn_name }} [{{ $inspection_testing->visitorhelperEmployee->old_pin }}]  [{{ $inspection_testing->visitorhelperEmployee->new_pin }}]</td>
                <td>{{ $inspection_testing->visitorhelperDesignation->bn_name }}</td>
                <td class="">{{ $inspection_testing->fill_inspection_book }}</td>
                <td class="">{{ $inspection_testing->fill_inspection_seat_number }}</td>
                <td class="">{{ $inspection_testing->inspection_short_remarks }}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left">@lang('inspection_testing.driver')</td>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{--{{ $inspection_testing->product->type->bn_name }}--}} </td>

            <td class="bb-none bl-none" style="text-align: right">@lang('inspection_testing.ad_dad')</td>
        </tr>
    </table>
@endsection
