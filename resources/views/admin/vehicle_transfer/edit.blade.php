@extends('admin.layouts.master')

@section('title') @lang('common.edit',['model' => trans('vehicle_transfer.vehicle_transfer')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('vehicle_transfer.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('vehicle_transfer.vehicle_transfer')])@endslot
        @slot('li_2')@lang('common.edit',['model' => trans('vehicle_transfer.vehicle_transfer')])@endslot
        @slot('title')@lang('common.edit',['model' => trans('vehicle_transfer.vehicle_transfer')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($vehicle_transfer,['url' => route('vehicle_transfer.update',$vehicle_transfer->id), 'method' => 'patch','class' => 'custom-validation vehicle_transfer_submit','enctype' => "multipart/form-data"]) }}
                        @include('admin.vehicle_transfer.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


