@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('supplier.supplier')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('supplier.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('supplier.supplier')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('supplier.supplier')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('supplier.supplier')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($supplier,['url' => route('supplier.update',$supplier->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.supplier.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


