@extends('admin.layouts.pdf')

@section('title') @lang('tyre_record.tyre_record') {{ $tyre_record->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc">
                <p class="sgtc" style="border-radius: 15px; padding:15px;">@lang('tyre_record.tyre_record')</p>
            </td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{-- @lang('product.product'): --}}
                {{$tyre_record->product->type->bn_name}} -
                {{$tyre_record->product->category->bn_name}} -
                {{$tyre_record->product->brand->bn_name}} -
                {{$tyre_record->product->model->bn_name}} -
                ( {{$tyre_record->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-center">লুব্রিকেন্ট রেকর্ড নং: {{$tyre_record->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla($tyre_record->created_at ? date('d-m-Y',strtotime($tyre_record->created_at)) : '') }} খ্রিঃ</td>
        </tr>
    </table>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td> @lang('common.serial') </td>
            <td>@lang('tyre_record.issue_date')</td>
            <td>@lang('tyre_record.tyre_serial_number')</td>
            <td>@lang('tyre_record.tyre_number')</td>
            <td>@lang('tyre_record.tyre_size')</td>
            <td>@lang('tyre_record.tyre_ply')</td>
            <td>@lang('tyre_record.manufacturer_brand_id')</td>
            <td>@lang('tyre_record.manufacturer_country_id')</td>
            <td>@lang('tyre_record.rotation_date')</td>
            <td>@lang('tyre_record.rotation_meter_reading')</td>
            <td>@lang('tyre_record.rejected_announced_date')</td>
            <td>@lang('tyre_record.rejected_announce_meter_reading')</td>
            <td>@lang('tyre_record.rejected_announce_tyre_number')</td>
            <td>@lang('tyre_record.driver_employee_id')</td>
            <td>@lang('tyre_record.sso_so_employee_id')</td>
        </tr>
        @foreach($tyre_record->tyreRecordDetails as $key => $tyreRecordDetail)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}</td>
                <td>{{ $tyreRecordDetail->issue_date  ? date('d-m-Y',strtotime($tyreRecordDetail->issue_date )) : '' }}</td>
                <td>{{ $tyreRecordDetail->tyre_serial_number }}</td>
                <td>{{ $tyreRecordDetail->tyre_number }}</td>
                <td>{{ $tyreRecordDetail->tyre_size }}</td>
                <td>{{ $tyreRecordDetail->tyre_ply }}</td>
                <td>{{ $tyreRecordDetail->brand->bn_name }}</td>
                <td>{{ $tyreRecordDetail->country->bn_name}}</td>
                <td>{{ $tyreRecordDetail->rotation_date  ? date('d-m-Y',strtotime($tyreRecordDetail->rotation_date )) : '' }}</td>
                <td>{{ $tyreRecordDetail->rotation_meter_reading }}</td>
                <td>{{ $tyreRecordDetail->rejected_announced_date  ? date('d-m-Y',strtotime($tyreRecordDetail->rejected_announced_date )) : '' }}</td>
                <td>{{ $tyreRecordDetail->rejected_announce_meter_reading }}</td>
                <td>{{ $tyreRecordDetail->rejected_announce_tyre_number }}</td>
                <td>
                    @if(@$tyreRecordDetail->employeeDriver->bn_name)
                        {{ App::getLocale() == 'bn' ? @$tyreRecordDetail->employeeDriver->bn_name : @$tyreRecordDetail->employeeDriver->name }}
                        [{{ @$tyreRecordDetail->employeeDriver->old_pin }}]
                        [{{ @$tyreRecordDetail->employeeDriver->new_pin }}]
                    @endif
                </td>
                <td>
                    @if(@$tyreRecordDetail->employeeSsoSo->bn_name)
                        {{ App::getLocale() == 'bn' ? @$tyreRecordDetail->employeeSsoSo->bn_name : @$tyreRecordDetail->employeeSsoSo->name }}
                        [{{ @$tyreRecordDetail->employeeSsoSo->old_pin }}]
                        [{{ @$tyreRecordDetail->employeeSsoSo->new_pin }}]
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left; width: 33%;">@lang('tyre_record.driver')</td>

            <td class="bb-none bl-none" style="text-align: center; width: 33%;"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{ $tyre_record->product->type->bn_name }} </td>

            <td class="bb-none bl-none" style="text-align: right; width: 33%;">@lang('tyre_record.ad_dad')</td>
        </tr>
    </table>
@endsection
