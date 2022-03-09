@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('battery_record.battery_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('battery_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('battery_record.battery_record')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('battery_record.battery_record')])@endslot
        @slot('title')@lang('common.view',['model' => trans('battery_record.battery_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $battery_record->tracking_no }} @lang('battery_record.battery_records')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('battery_record.tracking_no')</th>
                                <td class="text-uppercase">{{ $battery_record->product->tracking_no }} [{{ $battery_record->product->registration_number }}]</td>
                                <th>@lang('type.type')</th>
                                <td class="text-uppercase">{{ $battery_record->product->type->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('category.category')</th>
                                <td class="text-uppercase">{{ $battery_record->product->category->bn_name }}</td>
                                <th>@lang('brand.brand')</th>
                                <td class="text-uppercase">{{ $battery_record->product->brand->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('model.model')</th>
                                <td class="text-uppercase">{{ $battery_record->product->model->bn_name }}</td>

                                <th>@lang('battery_record.battery_size_length')</th>
                                <td class="text-uppercase">{{ $battery_record->battery_size_length }}</td>
                            </tr>

                            <tr>
                                <th>@lang('battery_record.battery_size_width')</th>
                                <td class="text-uppercase">{{ $battery_record->battery_size_width }}</td>
                                <th>@lang('battery_record.battery_size_height')</th>
                                <td class="text-uppercase">{{ $battery_record->battery_size_height }}</td>
                            </tr>
                            <tr>
                                <th>@lang('battery_record.battery_numbers')</th>
                                <td class="text-uppercase">{{ $battery_record->battery_numbers }}</td>
                                <th>@lang('battery_record.battery_plate')</th>
                                <td class="text-uppercase">{{ $battery_record->battery_plate }}</td>

                            </tr>
                            <tr>
                                <th>@lang('battery_record.battery_ampere')</th>
                                <td class="text-uppercase">{{ $battery_record->battery_ampere }}</td>
                            </tr>

                        </tbody>
                    </table>

                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="background-color: #e4e4e4">
                        <tbody>


                        </tbody>
                    </table>

                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="16" span="8" class="p-2 text-center bg-info font-size-14
                                text-white">@lang('battery_record.battery_records')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('battery_record.issue_date')</th>
                                <th>@lang('battery_record.battery_brand')</th>
                                <th>@lang('battery_record.battery_number')</th>
                                <th>@lang('battery_record.full_charge_gravity')</th>
                                <th>@lang('battery_record.rejected_announced_date')</th>
                                <th>@lang('battery_record.duty_driver_employee_id')</th>
                                <th>@lang('battery_record.sso_employee_id')</th>
                            </tr>
                            @foreach($battery_record->batteryDetails as $key => $battery_record)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $battery_record->issue_date ? date('d-m-Y',strtotime($battery_record->issue_date)) : '' }}</td>
                                    <td>{{ $battery_record->battery_brand }}</td>
                                    <td>{{ $battery_record->battery_number }}</td>
                                    <td>{{ $battery_record->full_charge_gravity }}</td>
                                    <td>{{ $battery_record->rejected_announced_date ? date('d-m-Y',strtotime($battery_record->rejected_announced_date)) : '' }}</td>
                                    <td>{{ $battery_record->driverEmployee->bn_name }} [{{ $battery_record->driverEmployee->old_pin }}]  [{{ $battery_record->driverEmployee->new_pin }}]</td>
                                    <td>{{ $battery_record->ssoEmployee->bn_name }} [{{ $battery_record->ssoEmployee->old_pin }}]  [{{ $battery_record->ssoEmployee->new_pin }}]</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
