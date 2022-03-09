@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('workshop.workshop')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('workshop.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('workshop.workshop')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('workshop.workshop')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('workshop.workshop')])@endslot

    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($workshop,['url' => route('workshop.update',$workshop->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.workshop.form')
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

@endsection


