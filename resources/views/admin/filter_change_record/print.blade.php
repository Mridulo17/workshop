@extends('admin.layouts.pdf')

@section('title') @lang('filter_change_record.filter_change_record') {{ $filter_change_record->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">
                    @lang('filter_change_record.filter_change_record')
                </p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left">
                {{$filter_change_record->product->type->bn_name}} -
                {{$filter_change_record->product->category->bn_name}} -
                {{$filter_change_record->product->brand->bn_name}} -
                {{$filter_change_record->product->model->bn_name}} -
                ( {{$filter_change_record->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-center">ফিল্টার পরিবর্তন নং: {{ $filter_change_record->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($filter_change_record->order_date)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
    </table>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td>@lang('common.serial') </td>
            <td>@lang('filter_change_record.mobil_filter')</td>
            <td>@lang('filter_change_record.diesel_filter')</td>
            <td>@lang('filter_change_record.air_filter')</td>
            <td>@lang('filter_change_record.change_date')</td>
            <td>@lang('filter_change_record.substituter')</td>
            <td>@lang('filter_change_record.sso')</td>
        </tr>
        @foreach($filter_change_record->filterChangeDetails as $filterChangeDetail)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}</td>
                <td class="">{{ $filterChangeDetail->mobil_filter }}</td>
                <td class="">{{ $filterChangeDetail->diesel_filter }}</td>
                <td class="">{{ $filterChangeDetail->air_filter }}</td>
                <td class="">{{ $filterChangeDetail->change_date ? date('d-m-Y',strtotime($filterChangeDetail->change_date)) : '' }}</td>
                <td class="">
                    @if(@$filterChangeDetail->substitutorEmployee->bn_name)
                        {{ App::getLocale() == 'bn' ?
                            @$filterChangeDetail->substitutorEmployee->bn_name
                        :   @$filterChangeDetail->substitutorEmployee->name
                         }}
                        [{{ @$filterChangeDetail->substitutorEmployee->old_pin }}] [{{ @$filterChangeDetail->substitutorEmployee->new_pin }}]
                    @endif
                </td>
                <td class="">@if(@$filterChangeDetail->ssoEmployee->bn_name)
                        {{ App::getLocale() == 'bn' ?
                            @$filterChangeDetail->ssoEmployee->bn_name
                        :   @$filterChangeDetail->ssoEmployee->name
                         }}
                        [{{ @$filterChangeDetail->ssoEmployee->old_pin }}] [{{ @$filterChangeDetail->ssoEmployee->new_pin }}]
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left">@lang('filter_change_record.driver')</td>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{--{{ $filter_change_record->workshop->bn_name }}--}} </td>

            <td class="bb-none bl-none" style="text-align: right">@lang('filter_change_record.ad_dad')</td>
        </tr>
    </table>
@endsection
