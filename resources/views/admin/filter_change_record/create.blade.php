@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('filter_change_record.filter_change_record')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('filter_change_record.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('filter_change_record.filter_change_record')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('filter_change_record.filter_change_record')])@endslot
        @slot('title')@lang('common.create',['model' => trans('filter_change_record.filter_change_record')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('filter_change_record.store'), 'method' => 'post','class' => 'custom-validation filter_change_submit','enctype' => "multipart/form-data"]) }}
                        @include('admin.filter_change_record.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


