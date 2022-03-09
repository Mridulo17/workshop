@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('repair_summary.repair_summary')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('repair_summary.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('repair_summary.repair_summary')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('repair_summary.repair_summary')])@endslot
        @slot('title')@lang('common.view',['model' => trans('repair_summary.repair_summary')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $repair_summary->tracking_no }} @lang('repair_summary.repair_summary_details')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                        <tr>
                            <th>@lang('lubricant_record.tracking_no')</th>
                            <td class="text-uppercase">{{ $repair_summary->product->tracking_no }}</td>
                            <th>@lang('type.type')</th>
                            <td class="text-uppercase">{{ $repair_summary->product->type->bn_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('category.category')</th>
                            <td class="text-uppercase">{{ $repair_summary->product->category->bn_name }}</td>
                            <th>@lang('brand.brand')</th>
                            <td class="text-uppercase">{{ $repair_summary->product->brand->bn_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('model.model')</th>
                            <td class="text-uppercase">{{ $repair_summary->product->model->bn_name }}</td>
                            <th>@lang('product.product')</th>
                            <td class="text-uppercase">{{ $repair_summary->product->tracking_no }} [{{ $repair_summary->product->registration_number }}]</td>
                        </tr>
                        <tr>
                            <th>@lang('repair_summary.job_number')</th>
                            <td class="text-uppercase">{{ $repair_summary->job_number }}</td>
                            <th>@lang('repair_summary.workshop_employee')</th>
                            <td class="text-uppercase">{{ $repair_summary->workshopEmployee->bn_name }} [{{ $repair_summary->workshopEmployee->old_pin }}] [{{ $repair_summary->workshopEmployee->new_pin }}]</td>
                        </tr>
                        <tr>
                            <th>@lang('repair_summary.in_date')</th>
                            <td class="text-uppercase">{{ $repair_summary->in_date  ? date('d-m-Y',strtotime($repair_summary->in_date )) : '' }}</td>
                            <th>@lang('repair_summary.in_mileage')</th>
                            <td class="text-uppercase">{{ $repair_summary->in_mileage }}</td>
                        </tr>
                        <tr>
                            <th>@lang('repair_summary.out_date')</th>
                            <td class="text-uppercase">{{ $repair_summary->out_date  ? date('d-m-Y',strtotime($repair_summary->out_date )) : '' }}</td>
                            <th>@lang('repair_summary.out_mileage')</th>
                            <td class="text-uppercase">{{ $repair_summary->out_mileage }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="9" class="p-2 text-center bg-info font-size-14 text-white">@lang('repair_summary.repair')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('repair_summary.repair_details')</th>
                                <th>@lang('repair_summary.quantity')</th>
                            </tr>
                            @foreach($repair_summary->repairSummaryDetails as $key => $repairSummaryDetail)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $repairSummaryDetail->repair_details }}</td>
                                    <td>{{ $repairSummaryDetail->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
