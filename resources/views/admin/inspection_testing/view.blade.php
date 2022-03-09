@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('inspection_testing.inspection_testing')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('inspection_testing.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('inspection_testing.inspection_testing')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('inspection_testing.inspection_testing')])@endslot
        @slot('title')@lang('common.view',['model' => trans('inspection_testing.inspection_testing')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $inspection_testing->tracking_no }} @lang('inspection_testing.inspection_testings')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('inspection_testing.tracking_no')</th>
                                <td class="text-uppercase">{{ $inspection_testing->product->tracking_no }} [{{ $inspection_testing->product->registration_number }}]</td>
                                <th>@lang('type.type')</th>
                                <td class="text-uppercase">{{ $inspection_testing->product->type->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('category.category')</th>
                                <td class="text-uppercase">{{ $inspection_testing->product->category->bn_name }}</td>
                                <th>@lang('brand.brand')</th>
                                <td class="text-uppercase">{{ $inspection_testing->product->brand->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('model.model')</th>
                                <td class="text-uppercase">{{ $inspection_testing->product->model->bn_name }}</td>
{{--                                <th>@lang('inspection_testing.order_date')</th>--}}
{{--                                <td lang="bang">{{ date('d-m-Y',strtotime($inspection_testing->order_date)) }}</td>--}}
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="16" span="8" class="p-2 text-center bg-info font-size-14
                                text-white">@lang('inspection_testing.inspection_testings')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('inspection_testing.visitor_employee_id')</th>
                                <th>@lang('inspection_testing.visitor_designation_id')</th>
                                <th>@lang('inspection_testing.visitor_helper_employee_id')</th>
                                <th>@lang('inspection_testing.visitor_helper_designation_id')</th>
                                <th>@lang('inspection_testing.fill_inspection_book')</th>
                                <th>@lang('inspection_testing.fill_inspection_seat_number')</th>
                                <th>@lang('inspection_testing.inspection_short_remarks')</th>
                            </tr>
                            @foreach($inspection_testing->inspectionTestingDetails as $key => $inspection_testing)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $inspection_testing->visitorEmployee->bn_name }} [{{ $inspection_testing->visitorEmployee->old_pin }}]  [{{ $inspection_testing->visitorEmployee->new_pin }}]</td>
                                    <td>{{ $inspection_testing->visitorDesignation->bn_name }} </td>
                                    <td>{{ $inspection_testing->visitorhelperEmployee->bn_name }} [{{ $inspection_testing->visitorhelperEmployee->old_pin }}]  [{{ $inspection_testing->visitorhelperEmployee->new_pin }}]</td>
                                    <td>{{ $inspection_testing->visitorhelperDesignation->bn_name }}</td>
                                    <td>{{ $inspection_testing->fill_inspection_book }}</td>
                                    <td>{{ $inspection_testing->fill_inspection_seat_number }}</td>
                                    <td>{{ $inspection_testing->inspection_short_remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
