@extends('admin.layouts.master')

@section('title') @lang('fire_station_type.edit_title') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('fire_station_type.index')}}@endslot
        @slot('li_1')@lang('fire_station_type.index_title')@endslot
        @slot('li_2')@lang('fire_station_type.edit_title')@endslot
        @slot('title')@lang('fire_station_type.edit_title')@endslot

    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($fire_station_type,['url' => route('fire_station_type.update',$fire_station_type->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.fire_station_type.form')
                    {{ Form::close() }}

                </div>
            </div>


        </div> <!-- end col -->
    </div>
@endsection


