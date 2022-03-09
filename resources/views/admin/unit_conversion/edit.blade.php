@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('unit_conversion.unit_conversion')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('unit_conversion.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('unit_conversion.unit_conversion')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('unit_conversion.unit_conversion')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('unit_conversion.unit_conversion')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($unit_conversion,['url' => route('unit_conversion.update',$unit_conversion->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.unit_conversion.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


