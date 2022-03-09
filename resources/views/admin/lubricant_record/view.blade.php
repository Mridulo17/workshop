@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('lubricant_record.lubricant_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('lubricant_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('lubricant_record.lubricant_record')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('lubricant_record.lubricant_record')])@endslot
        @slot('title')@lang('common.view',['model' => trans('lubricant_record.lubricant_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $lubricant_record->tracking_no }} @lang('lubricant_record.lubricant_record_details')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('lubricant_record.tracking_no')</th>
                                <td class="text-uppercase">{{ $lubricant_record->product->tracking_no }}</td>
                                <th>@lang('type.type')</th>
                                <td class="text-uppercase">{{ $lubricant_record->product->type->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('category.category')</th>
                                <td class="text-uppercase">{{ $lubricant_record->product->category->bn_name }}</td>
                                <th>@lang('brand.brand')</th>
                                <td class="text-uppercase">{{ $lubricant_record->product->brand->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('model.model')</th>
                                <td class="text-uppercase">{{ $lubricant_record->product->model->bn_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive w-100">
                        <thead>
                            <tr>
                                <th colspan="10" span="10" class="p-2 text-center bg-info font-size-14
                                text-white">@lang('lubricant_record.lubricants')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('lubricant_record.mobil_oil')</th>
                                <th>@lang('lubricant_record.gear_oil')</th>
                                <th>@lang('lubricant_record.brake_oil')</th>
                                <th>@lang('lubricant_record.hydraulic_oil')</th>
                                <th>@lang('lubricant_record.grease')</th>
                                <th>@lang('lubricant_record.substituter')</th>
                                <th>@lang('lubricant_record.sso')</th>
                                <th>@lang('lubricant_record.substituter_date')</th>
                                <th>@lang('lubricant_record.sso_date')</th>
                            </tr>
                            @foreach($lubricant_record->lubricantDetails as $key => $lubricant_detail)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $lubricant_detail->mobil_oil }}</td>
                                    <td>{{ $lubricant_detail->gear_oil }}</td>
                                    <td>{{ $lubricant_detail->brake_oil }}</td>
                                    <td>{{ $lubricant_detail->hydraulic_oil }}</td>
                                    <td>{{ $lubricant_detail->grease }}</td>
                                    <td> @if(@$lubricant_detail->substitutorEmployee->bn_name)
                                            {{ App::getLocale() == 'bn' ?
                                                @$lubricant_detail->substitutorEmployee->bn_name
                                            :   @$lubricant_detail->substitutorEmployee->name
                                             }}
                                            [{{ @$lubricant_detail->substitutorEmployee->old_pin }}] [{{ @$lubricant_detail->substitutorEmployee->new_pin }}]
                                        @endif
                                    </td>

                                    <td>@if(@$lubricant_detail->ssoEmployee->bn_name)
                                        {{ App::getLocale() == 'bn' ?
                                        @$lubricant_detail->ssoEmployee->bn_name
                                         : @$lubricant_detail->ssoEmployee->name }} [{{ @$lubricant_detail->ssoEmployee->old_pin }}] [{{ @$lubricant_detail->ssoEmployee->new_pin }}]
                                        @endif
                                    </td>
                                    <td>{{ $lubricant_detail->substitutor_date ? date('d-m-Y',strtotime($lubricant_detail->substitutor_date)) : '' }}</td>
                                    <td>{{ $lubricant_detail->sso_date ? date('d-m-Y',strtotime($lubricant_detail->sso_date)) : '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
