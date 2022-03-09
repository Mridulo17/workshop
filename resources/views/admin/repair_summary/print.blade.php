@extends('admin.layouts.pdf')

@section('title') @lang('repair_summary.repair_summary') {{ $repair_summary->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('repair_summary.repair_summary')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left">
                {{$repair_summary->product->type->bn_name}} -
                {{$repair_summary->product->category->bn_name}} -
                {{$repair_summary->product->brand->bn_name}} -
                {{$repair_summary->product->model->bn_name}} -
                ({{$repair_summary->product->tracking_no}})
            </td>
            <td class="bb-none bl-none text-uppercase text-left">মেরামতি সংক্ষিপ্তসার নং: {{ $repair_summary->tracking_no }}</td>
            <td class="bb-none bl-none text-left">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($repair_summary->order_date)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
        <tr>
            <td class="bb-none bl-none">@lang('repair_summary.job_number')-{{$repair_summary->job_number}}</td>
            <td class="bb-none bl-none">@lang('repair_summary.in_date')-{{$repair_summary->in_date}}</td>
            <td class="bb-none bl-none">@lang('repair_summary.in_mileage')-{{$repair_summary->in_mileage}}</td>
        </tr>
        <tr>
            <td class="bb-none bl-none">@lang('repair_summary.out_date')-{{$repair_summary->out_date}}</td>
            <td class="bb-none bl-none ">@lang('repair_summary.out_mileage')-{{$repair_summary->out_mileage}}</td>
            <td class="bb-none bl-none">@lang('repair_summary.workshop_employee')-
                @if(@$repair_summary->workshopEmployee->bn_name)
                    {{ App::getLocale() == 'bn' ?
                        @$repair_summary->workshopEmployee->bn_name
                    :   @$repair_summary->workshopEmployee->name
                    }}
                    [{{ @$repair_summary->workshopEmployee->old_pin }}] [{{@$repair_summary->workshopEmployee->new_pin }}]
                @endif
            </td>
        </tr>
    </table>
    <br>
    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td> @lang('common.serial') </td>
            <td>@lang('repair_summary.repair_details')</td>
            <td>@lang('repair_summary.quantity')</td>
        </tr>
        @foreach($repair_summary->repairSummaryDetails as $key => $repairSummaryDetail)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}</td>
                <td class="">{{ $repairSummaryDetail->repair_details }}</td>
                <td class="">{{ $repairSummaryDetail->quantity }}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left">@lang('repair_summary.driver')</td>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{--{{ $repair_summary->workshop->bn_name }}--}} </td>

            <td class="bb-none bl-none" style="text-align: right">@lang('repair_summary.ad_dad')</td>
        </tr>
    </table>
@endsection
