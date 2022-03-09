@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('inspection_report.inspection_report')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('inspection_report.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('inspection_report.inspection_report')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('inspection_report.inspection_report')])@endslot
        @slot('title')@lang('common.create',['model' => trans('inspection_report.inspection_report')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('inspection_report.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.inspection_report.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


