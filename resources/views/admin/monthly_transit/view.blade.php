@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('monthly_transit.monthly_transit')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('monthly_transit.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('monthly_transit.monthly_transit')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('monthly_transit.monthly_transit')])@endslot
        @slot('title')@lang('common.view',['model' => trans('monthly_transit.monthly_transit')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $monthly_transit->tracking_no }} @lang('monthly_transit.monthly_transits')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('monthly_transit.tracking_no')</th>
                                <td class="text-uppercase">{{ $monthly_transit->product->tracking_no }} [{{ $monthly_transit->product->registration_number }}]</td>
                                <th>@lang('type.type')</th>
                                <td class="text-uppercase">{{ $monthly_transit->product->type->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('category.category')</th>
                                <td class="text-uppercase">{{ $monthly_transit->product->category->bn_name }}</td>
                                <th>@lang('brand.brand')</th>
                                <td class="text-uppercase">{{ $monthly_transit->product->brand->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('model.model')</th>
                                <td class="text-uppercase">{{ $monthly_transit->product->model->bn_name }}</td>
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
                                text-white">@lang('monthly_transit.monthly_transits')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('monthly_transit.month')</th>
                                <th>@lang('monthly_transit.kmpl_lph_per_month')</th>
                                <th>@lang('monthly_transit.fuel_cost')</th>
                                <th>@lang('monthly_transit.lubricant_cost')</th>
                                <th>@lang('monthly_transit.kmpl_lph_per_liter')</th>
                                <th>@lang('monthly_transit.sso_employee_id')</th>
                            </tr>
                            @foreach($monthly_transit->monthlyTransitDetails as $key => $monthly_transit_detail)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ \App\Models\MonthlyTransit::findMonth($monthly_transit_detail->month) }}</td>
                                    <td>{{ $monthly_transit_detail->kmpl_lph_per_month }}</td>
                                    <td>{{ $monthly_transit_detail->fuel_cost }}</td>
                                    <td>{{ $monthly_transit_detail->lubricant_cost }}</td>
                                    <td>{{ $monthly_transit_detail->kmpl_lph_per_liter }}</td>
                                    <td>{{ $monthly_transit_detail->employee->bn_name }} [{{ $monthly_transit_detail->employee->old_pin }}]  [{{ $monthly_transit_detail->employee->new_pin }}]</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
