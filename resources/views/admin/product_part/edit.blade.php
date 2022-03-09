@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('product_part.product_part')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('product_part.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('product_part.product_part')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('product_part.product_part')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('product_part.product_part')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($product_part,['url' => route('product_part.update',$product_part->id), 'method' => 'patch','class' => 'custom-validation', 'id' => 'product_part_form', 'files' => true]) }}
                        @include('admin.product_part.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection




