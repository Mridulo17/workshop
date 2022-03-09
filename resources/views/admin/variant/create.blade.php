@extends('admin.layouts.master')

@section('title') @lang('variant.create') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('variant.index')}}@endslot
        @slot('li_1')@lang('variant.index')@endslot
        @slot('li_2')@lang('variant.create')@endslot
        @slot('title')@lang('variant.create')@endslot

    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('variant.store'), 'method' => 'post','class' => 'custom-validation']) }}
                        @include('admin.variant.form')
                    {{ Form::close() }}

                </div>
            </div>


        </div> <!-- end col -->
    </div>
@endsection


