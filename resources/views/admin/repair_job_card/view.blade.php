@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('repair_job_card.repair_job_card')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('repair_job_card.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('repair_job_card.repair_job_card')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('repair_job_card.repair_job_card')])@endslot
        @slot('title')@lang('common.view',['model' => trans('repair_job_card.repair_job_card')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="8" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $repair_job_card->tracking_no }} @lang('repair_job_card.repair_job_cards')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('repair_job_card.tracking_no')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->tracking_no }} [{{ $repair_job_card->inspectionReport->registration_number }}]</td>
                                <th>@lang('type.type')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->product->type->bn_name }}</td>
                                <th>@lang('category.category')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->product->category->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('brand.brand')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->product->brand->bn_name }}</td>
                                <th>@lang('model.model')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->product->model->bn_name }}</td>
                                <th>@lang('product.product')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->product->tracking_no }}</td>
                            </tr>
                            <tr>
                                <th>@lang('product.registration_number')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->product->registration_number }}</td>
                                <th>@lang('workshop.workshop')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->workshop->bn_name }}</td>
                                <th>@lang('fire_station.fire_station')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->product->fire_station->bn_name }}</td>
                            </tr>

                            <tr>
                                <th>@lang('repair_job_card.meter_reading')</th>
                                <td class="text-uppercase">{{ $repair_job_card->inspectionReport->workshopOrder->meter_reading }}</td>
                                <th>@lang('repair_job_card.in_date')</th>
                                <td class="text-uppercase">{{ $repair_job_card->in_date ? date('d-m-Y',strtotime($repair_job_card->in_date)) : '' }}</td>
                                <th>@lang('repair_job_card.out_date')</th>
                                <td class="text-uppercase">{{ $repair_job_card->out_date ? date('d-m-Y',strtotime($repair_job_card->out_date)) : '' }}</td>
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
                                text-white">@lang('repair_job_card.repair_job_cards')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('workshop_order.fault')</th>
                                <th>@lang('repair_job_card.demand')</th>
                                <th>@lang('repair_job_card.issue_product_part')</th>
                                <th>@lang('common.amount')</th>
                                <th>@lang('repair_job_card.receipt_place')</th>
                                <th>@lang('repair_job_card.unit')</th>
                                <th>@lang('repair_job_card.total')</th>
                                <th>@lang('repair_job_card.manpower_number_type')</th>
                                <th>@lang('repair_job_card.total_manpower_cost')</th>
                                <th>@lang('repair_job_card.total_cost')</th>
                                <th>@lang('common.remarks')</th>
                            </tr>
                            @foreach($repair_job_card->repairJobCardDetails as $key => $repair_job_card)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $repair_job_card->fault }}</td>
                                    <td>{{ $repair_job_card->demand }}</td>
                                    <td>{{ $repair_job_card->issue_product_part }}</td>
                                    <td>{{ $repair_job_card->amount }}</td>
                                    <td>{{ $repair_job_card->receipt_place }}</td>
                                    <td>{{ $repair_job_card->unit }}</td>
                                    <td>{{ $repair_job_card->total }}</td>
                                    <td>{{ $repair_job_card->manpower_number_type }}</td>
                                    <td>{{ $repair_job_card->total_manpower_cost }}</td>
                                    <td>{{ $repair_job_card->total_cost }}</td>
                                    <td>{{ $repair_job_card->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
