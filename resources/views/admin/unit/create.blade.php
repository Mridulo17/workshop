@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('unit.unit')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('unit.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('unit.unit')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('unit.unit')])@endslot
        @slot('title')@lang('common.create',['model' => trans('unit.unit')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('unit.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.unit.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


