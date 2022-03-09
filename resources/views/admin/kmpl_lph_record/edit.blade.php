@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('kmpl_lph_record.kmpl_lph_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('kmpl_lph_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('kmpl_lph_record.kmpl_lph_record')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('kmpl_lph_record.kmpl_lph_record')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('kmpl_lph_record.kmpl_lph_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($kmpl_lph_record,['url' => route('kmpl_lph_record.update',$kmpl_lph_record->id), 'method' => 'patch','class' => 'custom-validation','enctype' => "multipart/form-data"]) }}
                        @include('admin.kmpl_lph_record.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


