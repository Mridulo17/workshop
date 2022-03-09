@extends('admin.layouts.pdf')

@section('title') @lang('lubricant_record.lubricant_record') {{ $lubricant_record->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('lubricant_record.lubricant_record')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{$lubricant_record->product->type->bn_name}} -
                {{$lubricant_record->product->category->bn_name}} -
                {{$lubricant_record->product->brand->bn_name}} -
                {{$lubricant_record->product->model->bn_name}} -
                ( {{$lubricant_record->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-center">লুব্রিকেন্ট রেকর্ড নং: {{$lubricant_record->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla($lubricant_record->created_at ? date('d-m-Y',strtotime($lubricant_record->created_at)) : '') }} খ্রিঃ</td>
        </tr>
    </table>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td> @lang('common.serial') </td>
            <td> @lang('lubricant_record.mobil_oil') </td>
            <td> @lang('lubricant_record.gear_oil') </td>
            <td> @lang('lubricant_record.brake_oil') </td>
            <td> @lang('lubricant_record.hydraulic_oil') </td>
            <td> @lang('lubricant_record.grease') </td>
            <td> @lang('lubricant_record.substituter')</td>
            <td> @lang('lubricant_record.sso')</td>
            <td> @lang('lubricant_record.substituter_date') </td>
            <td> @lang('lubricant_record.sso_date') </td>
        </tr>
        @foreach($lubricant_record->lubricantDetails as $key => $lubricant_detail)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}</td>
                <td>{{ $lubricant_detail->mobil_oil }}</td>
                <td>{{ $lubricant_detail->gear_oil }}</td>
                <td>{{ $lubricant_detail->brake_oil }}</td>
                <td>{{ $lubricant_detail->hydraulic_oil }}</td>
                <td>{{ $lubricant_detail->grease }}</td>
                <td>@if(@$lubricant_detail->substitutorEmployee->bn_name)
                        {{ App::getLocale() == 'bn' ?
                            @$lubricant_detail->substitutorEmployee->bn_name
                        :   @$lubricant_detail->substitutorEmployee->name
                        }}
                        [{{ @$lubricant_detail->substitutorEmployee->old_pin }}] [{{@$lubricant_detail->substitutorEmployee->new_pin }}]
                    @endif</td>
                <td>@if(@$lubricant_detail->ssoEmployee->bn_name)
                        {{ App::getLocale() == 'bn' ?
                           @$lubricant_detail->ssoEmployee->bn_name
                         : @$lubricant_detail->ssoEmployee->name}}[{{ @$lubricant_detail->ssoEmployee->old_pin }}][{{ @$lubricant_detail->ssoEmployee->new_pin }}]
                    @endif
                </td>
                <td>{{ $lubricant_detail->substitutor_date ? date('d-m-Y',strtotime($lubricant_detail->substitutor_date)) : '' }}</td>
                <td>{{ $lubricant_detail->sso_date ? date('d-m-Y',strtotime($lubricant_detail->sso_date)) : '' }}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left">@lang('lubricant_record.driver')</td>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{ $lubricant_record->product->type->bn_name }} </td>

            <td class="bb-none bl-none" style="text-align: right">@lang('lubricant_record.ad_dad')</td>
        </tr>
    </table>
@endsection
