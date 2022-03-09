@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('tyre_record.tyre_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('tyre_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('tyre_record.tyre_record')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('tyre_record.tyre_record')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('tyre_record.tyre_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($tyre_record,['url' => route('tyre_record.update',$tyre_record->id), 'method' => 'patch','class' => 'custom-validation','enctype' => "multipart/form-data"]) }}
                        @include('admin.tyre_record.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


