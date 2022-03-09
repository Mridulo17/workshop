@extends('admin.layouts.master')

@section('title') @lang('common.create',['model' => trans('repair_job_card.repair_job_card')]) @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('repair_job_card.index')}}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('repair_job_card.repair_job_card')])@endslot
        @slot('li_2')@lang('common.create',['model' => trans('repair_job_card.repair_job_card')])@endslot
        @slot('title')@lang('common.create',['model' => trans('repair_job_card.repair_job_card')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('repair_job_card.store'), 'method' => 'post','class' => 'custom-validation','enctype' => "multipart/form-data"]) }}
                        @include('admin.repair_job_card.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


