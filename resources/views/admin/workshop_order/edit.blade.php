@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('workshop_order.workshop_order')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('workshop_order.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('workshop_order.workshop_order')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('workshop_order.workshop_order')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('workshop_order.workshop_order')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($workshop_order,['url' => route('workshop_order.update',$workshop_order->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.workshop_order.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


