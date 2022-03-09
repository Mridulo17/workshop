@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('model.model')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('model.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('model.model')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('model.model')])@endslot
        @slot('title')@lang('common.create',['model' => trans('model.model')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('model.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.model.form')
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

@endsection


