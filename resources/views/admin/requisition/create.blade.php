@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('requisition.requisition')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('requisition.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('requisition.requisition')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('requisition.requisition')])@endslot
        @slot('title')@lang('common.create',['model' => trans('requisition.requisition')])@endslot
    @endcomponent

    {{-- @include('admin.requisition.search_product_form') --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('requisition.store'), 'method' => 'post','class' => 'custom-validation requisition_submit','enctype' => "multipart/form-data"]) }}
                    @include('admin.requisition.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


