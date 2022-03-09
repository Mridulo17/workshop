@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('inspection_testing.inspection_testing')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('inspection_testing.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('inspection_testing.inspection_testing')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('inspection_testing.inspection_testing')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('inspection_testing.inspection_testing')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($inspection_testing,['url' => route('inspection_testing.update',$inspection_testing->id), 'method' => 'patch','class' => 'custom-validation inspection_testing_submit','enctype' => "multipart/form-data"]) }}
                        @include('admin.inspection_testing.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


