@extends('admin.layouts.master')

@section('title') @lang('common.view',['model' => trans('kmpl_lph_record.kmpl_lph_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('kmpl_lph_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('kmpl_lph_record.kmpl_lph_record')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('kmpl_lph_record.kmpl_lph_record')])@endslot
        @slot('title')@lang('common.view',['model' => trans('kmpl_lph_record.kmpl_lph_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $kmpl_lph_record->tracking_no }} @lang('kmpl_lph_record.kmpl_lph_record_details')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">
                            <tr>
                                <th>@lang('kmpl_lph_record.tracking_no')</th>
                                <td class="text-uppercase">{{ $kmpl_lph_record->product->tracking_no }}</td>
                                <th>@lang('type.type')</th>
                                <td class="text-uppercase">{{ $kmpl_lph_record->product->type->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('category.category')</th>
                                <td class="text-uppercase">{{ $kmpl_lph_record->product->category->bn_name }}</td>
                                <th>@lang('brand.brand')</th>
                                <td class="text-uppercase">{{ $kmpl_lph_record->product->brand->bn_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('model.model')</th>
                                <td class="text-uppercase">{{ $kmpl_lph_record->product->model->bn_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th colspan="8" span="8" class="p-2 text-center bg-info font-size-14
                                text-white">@lang('kmpl_lph_record.kmpl_lph_records')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>@lang('kmpl_lph_record.examiner_employee_id')</th>
                                <th>@lang('kmpl_lph_record.examiner_designation_id')</th>
                                <th>@lang('kmpl_lph_record.result_kmpl')</th>
                                <th>@lang('kmpl_lph_record.result_lph')</th>
                                <th>@lang('kmpl_lph_record.exam_date')</th>
                            </tr>
                            @foreach($kmpl_lph_record->kmplLphDetails as $key => $kmplLphDetail)
                                <tr>
                                    <td lang="bang">{{ $key+1 }}</td>
                                    <td>{{ $kmplLphDetail->examiner_employee->bn_name }}</td>
                                    <td>{{ $kmplLphDetail->examiner_designation->bn_name }}</td>
                                    <td>{{ $kmplLphDetail->result_kmpl }}</td>
                                    <td>{{ $kmplLphDetail->result_lph }}</td>
                                    <td>{{ $kmplLphDetail->exam_date ? date('d-m-Y',strtotime($kmplLphDetail->exam_date)) : "" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
