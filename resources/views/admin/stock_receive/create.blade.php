@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('stock_receive.stock_receive')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('stock_receive.index')}}@endslot
        @slot('li_1')@lang('stock_receive.index')@endslot
        @slot('li_2')@lang('stock_receive.create')@endslot
        @slot('title')@lang('stock_receive.create')@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('stock_receive.store'), 'method' => 'post','class' => 'custom-validation', 'id' => 'stock_receive_form']) }}
                        @include('admin.stock_receive.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


