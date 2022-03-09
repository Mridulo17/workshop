@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('workshop_order.workshop_order')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('workshop_order.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('workshop_order.workshop_order')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('workshop_order.workshop_order')])@endslot
        @slot('title')@lang('common.view',['model' => trans('workshop_order.workshop_order')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="3" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $workshop_order->tracking_no }} @lang('workshop_order.workshop_order_details')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('workshop_order.tracking_no')</th>
                                <td class="text-uppercase">{{ $workshop_order->tracking_no }}</td>
                            </tr>
                            <tr>
                                <th>@lang('workshop_order.order_date')</th>
                                <td lang="bang">{{ date('d-m-Y',strtotime($workshop_order->order_date)) }}</td>
                            </tr>
                            <tr>
                                <th>@lang('workshop_order.driver')</th>
                                <td lang="bang">
                                    {{ $workshop_order->driver->employee->bn_name.' ['.$workshop_order->driver->employee->old_pin.'] ['.$workshop_order->driver->employee->new_pin.']' }}
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('workshop_order.product_details')</th>
                                <td>{{ $workshop_order->product->bn_name.', '.$workshop_order->product->model->bn_name.', '.$workshop_order->product->model->brand->bn_name.' ('.$workshop_order->product_type.')' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="3" class="p-2 text-center bg-secondary font-size-14 text-white">@lang('workshop_order.faults')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('workshop_order.fault')</th>
                                <th>@lang('common.remarks')</th>
                            </tr>
                            @foreach($workshop_order->faults as $key => $fault)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $fault->name }}</td>
                                    <td>{{ $fault->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection