@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('driver_record.driver_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('driver_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('driver_record.driver_record')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('driver_record.driver_record')])@endslot
        @slot('title')@lang('common.view',['model' => trans('driver_record.driver_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $driver_record->tracking_no }} @lang('driver_record.driver_record')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                        <tr>
                            <th>@lang('driver_record.tracking_no')</th>
                            <td class="text-uppercase">{{ $driver_record->product->tracking_no }}</td>
                            <th>@lang('type.type')</th>
                            <td class="text-uppercase">{{ $driver_record->product->type->bn_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('category.category')</th>
                            <td class="text-uppercase">{{ $driver_record->product->category->bn_name }}</td>
                            <th>@lang('brand.brand')</th>
                            <td class="text-uppercase">{{ $driver_record->product->brand->bn_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('model.model')</th>
                            <td class="text-uppercase">{{ $driver_record->product->model->bn_name }}</td>
                            {{--                                <th>@lang('driver_record.order_date')</th>--}}
                            {{--                                <td lang="bang">{{ date('d-m-Y',strtotime($driver_record->order_date)) }}</td>--}}
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="12" span="8" class="p-2 text-center bg-info font-size-14
                                text-white">@lang('driver_record.driver_record')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>@lang('driver_record.driver_employee_id')</th>
                            <th>@lang('driver_record.in_date')</th>
                            <th>@lang('driver_record.in_meter_reading')</th>
                            <th>@lang('driver_record.out_date')</th>
                            <th>@lang('driver_record.out_meter_reading')</th>
                            <th>@lang('driver_record.sso_so_employee_id')</th>
                        </tr>
                            @foreach($driver_record->driverRecordDetails as $key => $driverRecordDetail)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $driverRecordDetail->driverEmployee->bn_name }}</td>
                                    <td>{{ $driverRecordDetail->in_date ? date('d-m-Y',strtotime($driverRecordDetail->in_date)) : '' }}</td>
                                    <td>{{ $driverRecordDetail->in_meter_reading }}</td>
                                    <td>{{ $driverRecordDetail->out_date ? date('d-m-Y',strtotime($driverRecordDetail->out_date)) : '' }}</td>
                                    <td>{{ $driverRecordDetail->out_meter_reading }}</td>
                                    <td>{{ $driverRecordDetail->ssoSoEmployee->bn_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
