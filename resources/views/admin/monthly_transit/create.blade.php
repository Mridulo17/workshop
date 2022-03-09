@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('monthly_transit.monthly_transit')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('monthly_transit.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('monthly_transit.monthly_transit')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('monthly_transit.monthly_transit')])@endslot
        @slot('title')@lang('common.create',['model' => trans('monthly_transit.monthly_transit')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('monthly_transit.store'), 'method' => 'post','class' => 'custom-validation monthly_transit_submit','enctype' => "multipart/form-data"]) }}
                        @include('admin.monthly_transit.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


