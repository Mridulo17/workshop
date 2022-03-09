@extends('admin.layouts.master')

@section('title') @lang('variant_type.create') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('variant_type.index')}}@endslot
        @slot('li_1')@lang('variant_type.index')@endslot
        @slot('li_2')@lang('variant_type.create')@endslot
        @slot('title')@lang('variant_type.create')@endslot

    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('variant_type.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.variant_type.form')
                    {{ Form::close() }}

                </div>
            </div>


        </div> <!-- end col -->
    </div>
@endsection


