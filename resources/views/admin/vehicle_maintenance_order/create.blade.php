@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('vehicle_maintenance_order.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])@endslot
        @slot('title')@lang('common.create',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('vehicle_maintenance_order.store'), 'method' => 'post','class' => 'custom-validation','enctype' => "multipart/form-data"]) }}
                        @include('admin.vehicle_maintenance_order.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


