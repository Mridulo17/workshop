@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('vehicle_maintenance_order.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])@endslot
        @slot('title')@lang('common.view',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $vehicle_maintenance_order->tracking_no }} @lang('vehicle_maintenance_order.vehicle_maintenance_orders')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('vehicle_maintenance_order.tracking_no')</th>
                                <td class="text-uppercase">{{ $vehicle_maintenance_order->product->tracking_no }} [{{ $vehicle_maintenance_order->product->registration_number }}]</td>
                                <th>@lang('type.type')</th>
                                <td class="text-uppercase">{{ $vehicle_maintenance_order->product->type->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('category.category')</th>
                                <td class="text-uppercase">{{ $vehicle_maintenance_order->product->category->bn_name }}</td>
                                <th>@lang('brand.brand')</th>
                                <td class="text-uppercase">{{ $vehicle_maintenance_order->product->brand->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('model.model')</th>
                                <td class="text-uppercase">{{ $vehicle_maintenance_order->product->model->bn_name }}</td>
{{--                                <th>@lang('vehicle_maintenance_order.order_date')</th>--}}
{{--                                <td lang="bang">{{ date('d-m-Y',strtotime($vehicle_maintenance_order->order_date)) }}</td>--}}
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="16" span="8" class="p-2 text-center bg-info font-size-14
                                text-white">@lang('vehicle_maintenance_order.vehicle_maintenance_orders')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('vehicle_maintenance_order.serial_number')</th>
                                <th>@lang('vehicle_maintenance_order.subject')</th>
                                <th>@lang('vehicle_maintenance_order.order_giving_employee_id')</th>
                                <th>@lang('vehicle_maintenance_order.memorandum_number')</th>
                                <th>@lang('vehicle_maintenance_order.memorandum_date')</th>
                            </tr>
                            @foreach($vehicle_maintenance_order->vehicleMaintenanceDetails as $key => $vehicle_maintenance_order_detail)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $vehicle_maintenance_order_detail->serial_number }}</td>
                                    <td>{{ $vehicle_maintenance_order_detail->subject }}</td>
                                    <td>{{ $vehicle_maintenance_order_detail->employee->bn_name }} [{{ $vehicle_maintenance_order_detail->employee->old_pin }}]  [{{ $vehicle_maintenance_order_detail->employee->new_pin }}]</td>
                                    <td>{{ $vehicle_maintenance_order_detail->memorandum_number }}</td>
                                    <td>{{ $vehicle_maintenance_order_detail->memorandum_date ? date('d-m-Y',strtotime($vehicle_maintenance_order_detail->memorandum_date)) : '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
