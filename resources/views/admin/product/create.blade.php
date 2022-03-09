@extends('admin.layouts.master')

@section('title') @lang('product.create') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{route('product.index')}}@endslot
        @slot('li_1')@lang('product.index')@endslot
        @slot('li_2')@lang('product.create')@endslot
        @slot('title')@lang('product.create')@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('product.store'), 'method' => 'post','class' => 'custom-validation', 'id' => 'product_form',]) }}
                        @include('admin.product.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection


