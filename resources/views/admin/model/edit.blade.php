@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('model.model')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('model.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('model.model')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('model.model')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('model.model')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($model,['url' => route('model.update',$model->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.model.form')
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

@endsection


