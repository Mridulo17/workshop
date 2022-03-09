@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('type.type')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('type.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('type.type')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('type.type')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('type.type')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($type,['url' => route('type.update',$type->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.type.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


