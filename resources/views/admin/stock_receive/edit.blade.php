@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('stock_receive.stock_receive')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('stock_receive.index')}}@endslot
        @slot('li_1')@lang('stock_receive.index')@endslot
        @slot('li_2')@lang('stock_receive.edit')@endslot
        @slot('title')@lang('stock_receive.edit')@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($stock_receive,['url' => route('stock_receive.update',$stock_receive->id), 'method' => 'patch','class' => 'custom-validation', 'id' => 'stock_receive_form']) }}
                        @include('admin.stock_receive.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection




