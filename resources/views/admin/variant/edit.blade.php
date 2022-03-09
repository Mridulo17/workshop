@extends('admin.layouts.master')

@section('title') @lang('variant.edit') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('variant.index')}}@endslot
        @slot('li_1')@lang('variant.index')@endslot
        @slot('li_2')@lang('variant.edit')@endslot
        @slot('title')@lang('variant.edit')@endslot

    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($variant,['url' => route('variant.update',$variant->id), 'method' => 'patch','class' => 'custom-validation']) }}
                        @include('admin.variant.form')
                    {{ Form::close() }}

                </div>
            </div>


        </div> <!-- end col -->
    </div>
@endsection


