@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('driver_assign.driver_assign')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('driver_assign.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('driver_assign.driver_assign')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('driver_assign.driver_assign')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('driver_assign.driver_assign')])@endslot

    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($driver_assign,['url' => route('driver_assign.update',$driver_assign->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.driver_assign.form')
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

@endsection


