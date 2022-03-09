@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('vehicle_transfer.vehicle_transfer')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('vehicle_transfer.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('vehicle_transfer.vehicle_transfer')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('vehicle_transfer.vehicle_transfer')])@endslot
        @slot('title')@lang('common.view',['model' => trans('vehicle_transfer.vehicle_transfer')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $vehicle_transfer->tracking_no }} @lang('vehicle_transfer.vehicle_transfer')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                        <tr>
                            <th>@lang('vehicle_transfer.tracking_no')</th>
                            <td class="text-uppercase">{{ $vehicle_transfer->product->tracking_no }}</td>
                            <th>@lang('type.type')</th>
                            <td class="text-uppercase">{{ $vehicle_transfer->product->type->bn_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('category.category')</th>
                            <td class="text-uppercase">{{ $vehicle_transfer->product->category->bn_name }}</td>
                            <th>@lang('brand.brand')</th>
                            <td class="text-uppercase">{{ $vehicle_transfer->product->brand->bn_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('model.model')</th>
                            <td class="text-uppercase">{{ $vehicle_transfer->product->model->bn_name }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="12" span="8" class="p-2 text-center bg-info font-size-14 text-white">@lang('vehicle_transfer.vehicle_transfer')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>@lang('vehicle_transfer.order_designation_id')</th>
                            <th>@lang('vehicle_transfer.order_number')</th>
                            <th>@lang('vehicle_transfer.order_date')</th>
                            <th>@lang('vehicle_transfer.from_employee_id')</th>
                            <th>@lang('vehicle_transfer.from_employee_designation_id')</th>
                            <th>@lang('vehicle_transfer.from_fire_station_id')</th>
                            <th>@lang('vehicle_transfer.to_employee_id')</th>
                            <th>@lang('vehicle_transfer.to_employee_designation_id')</th>
                            <th>@lang('vehicle_transfer.to_fire_station_id')</th>
                            <th>@lang('vehicle_transfer.transfer_date')</th>
                        </tr>
                            @foreach($vehicle_transfer->vehicleTransferDetails as $key => $vehicleTransferDetail)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
