@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('category.category')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('category.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('category.category')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('category.category')])@endslot
        @slot('title')@lang('common.create',['model' => trans('category.category')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('category.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.category.form')
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

@endsection


