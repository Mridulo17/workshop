@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('lubricant_record.lubricant_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('lubricant_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('lubricant_record.lubricant_record')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('lubricant_record.lubricant_record')])@endslot
        @slot('title')@lang('common.create',['model' => trans('lubricant_record.lubricant_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('lubricant_record.store'), 'method' => 'post','class' => 'custom-validation lubricant_record_submit','enctype' => "multipart/form-data"]) }}
                        @include('admin.lubricant_record.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


