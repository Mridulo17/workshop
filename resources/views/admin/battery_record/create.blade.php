@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('battery_record.battery_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('battery_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('battery_record.battery_record')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('battery_record.battery_record')])@endslot
        @slot('title')@lang('common.create',['model' => trans('battery_record.battery_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('battery_record.store'), 'method' => 'post','class' => 'custom-validation','enctype' => "multipart/form-data"]) }}
                        @include('admin.battery_record.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


