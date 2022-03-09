@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('type.type')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('type.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('type.type')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('type.type')])@endslot
        @slot('title')@lang('common.create',['model' => trans('type.type')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('type.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.type.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


