@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('driver_record.driver_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('driver_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('driver_record.driver_record')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('driver_record.driver_record')])@endslot
        @slot('title')@lang('common.create',['model' => trans('driver_record.driver_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('driver_record.store'), 'method' => 'post','class' => 'custom-validation driver_record_submit','enctype' => "multipart/form-data"]) }}
                        @include('admin.driver_record.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


