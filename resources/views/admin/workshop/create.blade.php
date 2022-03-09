@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('workshop.workshop')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('workshop.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('workshop.workshop')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('workshop.workshop')])@endslot
        @slot('title')@lang('common.create',['model' => trans('workshop.workshop')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('workshop.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.workshop.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


