@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('driver.driver')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('driver.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('driver.driver')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('driver.driver')])@endslot
        @slot('title')@lang('common.create',['model' => trans('driver.driver')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('driver.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.driver.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


