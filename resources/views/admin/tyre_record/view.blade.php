@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('tyre_record.tyre_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('tyre_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('tyre_record.tyre_record')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('tyre_record.tyre_record')])@endslot
        @slot('title')@lang('common.view',['model' => trans('tyre_record.tyre_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $tyre_record->tracking_no }} @lang('tyre_record.tyre_records')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('tyre_record.tracking_no')</th>
                                <td class="text-uppercase">{{ $tyre_record->product->tracking_no }}</td>
                                <th>@lang('type.type')</th>
                                <td class="text-uppercase">{{ $tyre_record->product->type->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('category.category')</th>
                                <td class="text-uppercase">{{ $tyre_record->product->category->bn_name }}</td>
                                <th>@lang('brand.brand')</th>
                                <td class="text-uppercase">{{ $tyre_record->product->brand->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('model.model')</th>
                                <td class="text-uppercase">{{ $tyre_record->product->model->bn_name }}</td>
                               {{-- <th>@lang('tyre_record.order_date')</th>
                               <td lang="bang">{{ date('d-m-Y',strtotime($tyre_record->order_date)) }}</td> --}}
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="17" span="8" class="p-2 text-center bg-info font-size-14
                                text-white">@lang('tyre_record.tyre_records')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('tyre_record.issue_date')</th>
                                <th>@lang('tyre_record.tyre_serial_number')</th>
                                <th>@lang('tyre_record.tyre_number')</th>
                                <th>@lang('tyre_record.tyre_size')</th>
                                <th>@lang('tyre_record.tyre_ply')</th>
                                <th>@lang('tyre_record.manufacturer_brand_id')</th>
                                <th>@lang('tyre_record.manufacturer_country_id')</th>
                                <th>@lang('tyre_record.rotation_date')</th>
                                <th>@lang('tyre_record.rotation_meter_reading')</th>
                                <th>@lang('tyre_record.rejected_announced_date')</th>
                                <th>@lang('tyre_record.rejected_announce_meter_reading')</th>
                                <th>@lang('tyre_record.rejected_announce_tyre_number')</th>
                                <th>@lang('tyre_record.driver_employee_id')</th>
                                <th>@lang('tyre_record.sso_so_employee_id')</th>
                                <th>@lang('common.status')</th>
                            </tr>
                           @foreach($tyre_record->tyreRecordDetails as $key => $tyreRecordDetail)
                               <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
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
                                    <td>{{ $tyreRecordDetail->status }}</td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
