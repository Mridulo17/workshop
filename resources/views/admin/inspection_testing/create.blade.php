@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('inspection_testing.inspection_testing')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('inspection_testing.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('inspection_testing.inspection_testing')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('inspection_testing.inspection_testing')])@endslot
        @slot('title')@lang('common.create',['model' => trans('inspection_testing.inspection_testing')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('inspection_testing.store'), 'method' => 'post','class' => 'custom-validation inspection_testing_submit','enctype' => "multipart/form-data"]) }}
                        @include('admin.inspection_testing.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


