@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('repair_summary.repair_summary')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('repair_summary.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('repair_summary.repair_summary')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('repair_summary.repair_summary')])@endslot
        @slot('title')@lang('common.create',['model' => trans('repair_summary.repair_summary')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('repair_summary.store'), 'method' => 'post','class' => 'custom-validation repair_summary_submit','enctype' => "multipart/form-data"]) }}
                        @include('admin.repair_summary.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


