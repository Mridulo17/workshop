@extends('admin.layouts.pdf')

@section('title') @lang('kmpl_lph_record.kmpl_lph_record') {{ $kmpl_lph_record->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('kmpl_lph_record.kmpl_lph_record')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{$kmpl_lph_record->product->type->bn_name}} -
                {{$kmpl_lph_record->product->category->bn_name}} -
                {{$kmpl_lph_record->product->brand->bn_name}} -
                {{$kmpl_lph_record->product->model->bn_name}} -
                ( {{$kmpl_lph_record->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-left">মাইলেজ রেকর্ড নং: {{$kmpl_lph_record->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla($kmpl_lph_record->created_at ? date('d-m-Y',strtotime($kmpl_lph_record->created_at)) : '') }} খ্রিঃ</td>
        </tr>
    </table>
    <br>
    <br>
    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td> @lang('common.serial') </td>
            <td> @lang('kmpl_lph_record.examiner_employee_id') </td>
            <td> @lang('kmpl_lph_record.examiner_designation_id') </td>
            <td> @lang('kmpl_lph_record.result_kmpl') </td>
            <td> @lang('kmpl_lph_record.result_lph') </td>
            <td> @lang('kmpl_lph_record.exam_date') </td>

        </tr>
        @foreach($kmpl_lph_record->kmplLphDetails as $key => $kmplLphDetail)
            <tr>
                <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}</td>
                <td>{{ $kmplLphDetail->examiner_employee->bn_name }}</td>
                <td>{{ $kmplLphDetail->examiner_designation->bn_name }}</td>
                <td>{{ $kmplLphDetail->result_kmpl }}</td>
                <td>{{ $kmplLphDetail->result_lph }}</td>
                <td>{{ $kmplLphDetail->exam_date ? date('d-m-Y',strtotime($kmplLphDetail->exam_date)) : "" }}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{ $kmpl_lph_record->product->type->bn_name }} </td>

{{--            <td class="bb-none bl-none" style="text-align: right">@lang('kmpl_lph_record.ad_dad')</td>--}}
        </tr>
    </table>
@endsection
