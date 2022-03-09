@extends('admin.layouts.pdf')

@section('title') @lang('vehicle_transfer.vehicle_transfer') {{ $vehicle_transfer->tracking_no }} @endsection

@section('header')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="gtc"><p class="sgtc" style=" border-radius: 15px;padding:15px;">@lang('vehicle_transfer.vehicle_transfer')</p></td>
        </tr>
    </table>
@endsection

@section('content')
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none text-left text-uppercase">
                {{$vehicle_transfer->product->type->bn_name}} -
                {{$vehicle_transfer->product->category->bn_name}} -
                {{$vehicle_transfer->product->brand->bn_name}} -
                {{$vehicle_transfer->product->model->bn_name}} -
                ( {{$vehicle_transfer->product->tracking_no}} )
            </td>
            <td class="bb-none bl-none text-uppercase text-center">গাড়ি/পাম্প বদলী নং: {{$vehicle_transfer->tracking_no }}</td>
            <td class="bb-none bl-none text-right">@lang('common.date') {{ \App\Helpers\ENTOBN::convert_to_bangla(\Carbon\Carbon::parse($vehicle_transfer->order_date)->format('d-m-Y')) }} খ্রিঃ</td>
        </tr>
    </table>

    <table style="border: 2px solid #000; height: 900px;">
        <tr>
            <td> @lang('common.serial') </td>
            <td>@lang('vehicle_transfer.order_designation_id')</td>
            <td>@lang('vehicle_transfer.order_number')</td>
            <td>@lang('vehicle_transfer.order_date')</td>
            <td>@lang('vehicle_transfer.from_employee_id')</td>
            <td>@lang('vehicle_transfer.from_employee_designation_id')</td>
            <td>@lang('vehicle_transfer.from_fire_station_id')</td>
            <td>@lang('vehicle_transfer.to_employee_id')</td>
            <td>@lang('vehicle_transfer.to_employee_designation_id')</td>
            <td>@lang('vehicle_transfer.to_fire_station_id')</td>
            <td>@lang('vehicle_transfer.transfer_date')</td>
        </tr>
            @foreach($vehicle_transfer->vehicleTransferDetails as $key => $vehicleTransferDetail)
                <tr>
                    <td class="text-center" style="width: 15px;">{{ \App\Helpers\ENTOBN::convert_to_bangla($loop->iteration) }}</td>
                    <td>{{ @$vehicleTransferDetail->orderDesignation->bn_name }}</td>
                    <td>{{ $vehicleTransferDetail->order_number }}</td>
                    <td>{{ $vehicleTransferDetail->order_date ? date('d-m-Y',strtotime($vehicleTransferDetail->order_date)) : ''}}</td>
                    <td>
                        @if(@$vehicleTransferDetail->fromEmployee->bn_name)
                            {{ App::getLocale() == 'bn' ? @$vehicleTransferDetail->fromEmployee->bn_name : @$vehicleTransferDetail->fromEmployee->name }} [{{ @$vehicleTransferDetail->fromEmployee->old_pin }}] [{{ @$vehicleTransferDetail->fromEmployee->new_pin }}]
                        @endif
                    </td>
                    <td>{{ @$vehicleTransferDetail->fromEmployeeDesignation->bn_name }}</td>
                    <td>{{ @$vehicleTransferDetail->fromFireStation->bn_name }}</td>
                    <td>
                        @if(@$vehicleTransferDetail->toEmployee->bn_name)
                            {{ App::getLocale() == 'bn' ? @$vehicleTransferDetail->toEmployee->bn_name : @$vehicleTransferDetail->toEmployee->name }} [{{ @$vehicleTransferDetail->toEmployee->old_pin }}] [{{ @$vehicleTransferDetail->toEmployee->new_pin }}]
                        @endif
                    </td>
                    <td>{{ @$vehicleTransferDetail->toEmployeeDesignation->bn_name }}</td>
                    <td>{{ @$vehicleTransferDetail->toFireStation->bn_name }}</td>
                    <td>{{ $vehicleTransferDetail->transfer_date ? date('d-m-Y',strtotime($vehicleTransferDetail->transfer_date)) : ''}}</td>
                </tr>
            @endforeach
    </table>
@endsection

@section('footer')
    <table class="fs" style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style="text-align: left">@lang('vehicle_transfer.driver')</td>

            <td class="bb-none bl-none" style="text-align: center"> সিনিয়র স্টেশন অফিসার <br> @lang('settings.website_title_short_4') <br> {{ $vehicle_transfer->product->type->bn_name }} </td>

            <td class="bb-none bl-none" style="text-align: right">@lang('vehicle_transfer.ad_dad')</td>
        </tr>
    </table>
@endsection
