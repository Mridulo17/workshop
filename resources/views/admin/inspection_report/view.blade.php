@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('inspection_report.inspection_report')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('inspection_report.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('inspection_report.inspection_report')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('inspection_report.inspection_report')])@endslot
        @slot('title')@lang('common.view',['model' => trans('inspection_report.inspection_report')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $inspection_report->tracking_no }} @lang('inspection_report.inspection_report_details')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('inspection_report.tracking_no')</th>
                                <td class="text-uppercase">{{ $inspection_report->tracking_no }}</td>
                                <th>@lang('inspection_report.inspection_date')</th>
                                <td lang="bang">{{ date('d-m-Y',strtotime($inspection_report->inspection_date)) }}</td>
                            </tr>
                            <tr>
                                <th>@lang('inspection_report.serial_number')</th>
                                <td lang="bang">{{ $inspection_report->serial_number }}</td>
                                <th>@lang('inspection_report.workshop_order_number')</th>
                                <td class="text-uppercase">{{ $inspection_report->workshopOrder->tracking_no }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="13" class="p-2 text-center bg-secondary font-size-14 text-white">@lang('inspection_report.demands')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                               <th> @lang('workshop_order.fault')</th>
                               <th> @lang('workshop_order.product_name')</th>
                               <th> @lang('workshop_order.repair_work')</th>
                               <th> @lang('common.amount')</th>
                               <th> @lang('common.remarks')</th>  </tr>
                            @foreach($inspection_report->demands as $key => $demand)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $demand->fault }}</td>
                                    <td>{{ $demand->productPart->tracking_no }}</td>
                                    <td>{{ $demand->repair_work }}</td>
                                    <td>{{ $demand->amount }}</td>
                                    <td>{{ $demand->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
