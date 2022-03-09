@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('filter_change_record.filter_change_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('filter_change_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('filter_change_record.filter_change_record')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('filter_change_record.filter_change_record')])@endslot
        @slot('title')@lang('common.view',['model' => trans('filter_change_record.filter_change_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $filter_change_record->tracking_no }} @lang('filter_change_record.filter_change_details_info')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                        <tr>
                            <th>@lang('lubricant_record.tracking_no')</th>
                            <td class="text-uppercase">{{ $filter_change_record->tracking_no }}</td>
                            <th>@lang('type.type')</th>
                            <td class="text-uppercase">{{ $filter_change_record->product->type->bn_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('category.category')</th>
                            <td class="text-uppercase">{{ $filter_change_record->product->category->bn_name }}</td>
                            <th>@lang('brand.brand')</th>
                            <td class="text-uppercase">{{ $filter_change_record->product->brand->bn_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('model.model')</th>
                            <td class="text-uppercase">{{ $filter_change_record->product->model->bn_name }}</td>
                           </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="7" class="p-2 text-center bg-info font-size-14 text-white">@lang('filter_change_record.filter_change_details')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('filter_change_record.mobil_filter')</th>
                                <th>@lang('filter_change_record.diesel_filter')</th>
                                <th>@lang('filter_change_record.air_filter')</th>
                                <th>@lang('filter_change_record.change_date')</th>
                                <th>@lang('filter_change_record.substituter')</th>
                                <th>@lang('filter_change_record.sso')</th>
                            </tr>
                            @foreach($filter_change_record->filterChangeDetails as $key => $filterChangeDetail)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $filterChangeDetail->mobil_filter }}</td>
                                    <td>{{ $filterChangeDetail->diesel_filter }}</td>
                                    <td>{{ $filterChangeDetail->air_filter }}</td>
                                    <td>{{ $filterChangeDetail->change_date ? date('d-m-Y',strtotime($filterChangeDetail->change_date)) : '' }}</td>
                                    <td>
                                        @if(@$filterChangeDetail->substitutorEmployee->bn_name)
                                            {{ App::getLocale() == 'bn' ?
                                                @$filterChangeDetail->substitutorEmployee->bn_name
                                            :   @$filterChangeDetail->substitutorEmployee->name
                                             }}
                                            [{{ @$filterChangeDetail->substitutorEmployee->old_pin }}] [{{ @$filterChangeDetail->substitutorEmployee->new_pin }}]
                                        @endif
                                    </td>
                                    <td>
                                        @if(@$filterChangeDetail->ssoEmployee->bn_name)
                                            {{ App::getLocale() == 'bn' ?
                                                @$filterChangeDetail->ssoEmployee->bn_name
                                            :   @$filterChangeDetail->ssoEmployee->name
                                             }}
                                            [{{ @$filterChangeDetail->ssoEmployee->old_pin }}] [{{ @$filterChangeDetail->ssoEmployee->new_pin }}]
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
