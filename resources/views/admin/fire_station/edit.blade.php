@extends('admin.layouts.master')

@section('title') @lang('fire_station.edit_title') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('fire_station.index')}}@endslot
        @slot('li_1')@lang('fire_station.index_title')@endslot
        @slot('li_2')@lang('fire_station.edit_title')@endslot
        @slot('title')@lang('fire_station.edit_title')@endslot

    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($fire_station,['url' => route('fire_station.update',$fire_station->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.fire_station.form')
                    {{ Form::close() }}

                </div>
            </div>


        </div> <!-- end col -->
    </div>
@endsection


