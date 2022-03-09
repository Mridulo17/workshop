@extends('admin.layouts.master')

@section('title') @lang('common.index',['model' => trans('product_part.product_part')]) @endsection

@section('thead')
    <tr>
        <th width="5%">#</th>
        <th>@lang('common.tracking_no')</th>
        <th>@lang('product.type')</th>
        <th>@lang('category.category')</th>
        <th>@lang('product_part.brand',['model' => trans('product_part.brand')])</th>
        <th>@lang('product_part.model',['model' => trans('product_part.model')])</th>
        <th>@lang('product_part.material')</th>
        <th>@lang('variant.variation')</th>
        <th width="5%">@lang('common.status',['model' => trans('product_part.product_part')])</th>
        <th width="12%">@lang('common.action',['model' => trans('product_part.product_part')])</th>
    </tr>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('title')@lang('common.index',['model' => trans('product_part.product_part')])@endslot
        @slot('create_button')
            <a href="{{route('product_part.create')}}" class="btn btn-info btn-sm waves-effect waves-light modal_lg_button">
                <i class="fa fa-plus-circle"></i> @lang('common.create',['model' => trans('product_part.product_part')])
            </a>
        @endslot
    @endcomponent

    <ul class="nav nav-tabs" id="Tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-primary" id="all_btn_tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">@lang('common.index_list',['model' => trans('country.country')])</button>
        </li>
        @if(\App\Helpers\MenuHelper::CustomElementPermission('deleted_list'))
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary" id="deleted_btn_tab" data-bs-toggle="tab" data-bs-target="#deleted_list" type="button" role="tab" aria-controls="deleted_list" aria-selected="false">@lang('common.deleted_list',['model' => trans('country.country')])</button>
            </li>
        @endif
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap w-100">
                                <thead class="thead-dark">
                                    @yield('thead')
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="deleted_list" role="tabpanel" aria-labelledby="deleted_list_tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="deleted_list_datatable" class="table table-bordered table-hover dt-responsive nowrap w-100">
                                <thead class="thead-dark">
                                    @yield('thead')
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    {{--yajra datatable--}}
    <script type="text/javascript">
        var updateThis;
        let datatable_columns = [
            {data: 'DT_RowIndex',name:"DT_RowIndex", orderable: false, searchable: false},
            {data: 'tracking_no',name: 'tracking_no',},
            {data: 'type.bn_name',name: 'type.bn_name',},
            {data: 'category.bn_name',name: 'category.bn_name',},
            {data: 'brand.bn_name',name: 'brand.bn_name',},
            {data: 'model.bn_name',name: 'model.bn_name',},
            {data: 'material',name: 'material',},
            {data: 'variation',name: 'variation',},
            {data: 'status',name: 'status',},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]

        let datatable_columns_defs = [
            {'bSortable': true, 'aTargets': [0,1,2,3,4]},
            {'bSearchable': false, 'aTargets': [0]},
            { className: 'text-center', targets: [0,3,4] },
            { className: 'text-uppercase', targets: [1] },
        ]

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            serverMethod: 'get',
            lengthMenu: [10, 25, 50,100],
            order: [ 0, "asc" ],
            language: {
                'loadingRecords': '&nbsp;',
                'processing': 'Loading ...'
            },
            ajax: {
                url: '{{ route('product_part.index') }}',
                type: 'get',
                dataType: 'JSON',
                cache: false,
            },
            columns: datatable_columns,
            search: {
                "regex": true
            },
            columnDefs: datatable_columns,
        });

        @if(\App\Helpers\MenuHelper::CustomElementPermission('deleted_list'))
            $('#deleted_list_datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                serverMethod: 'get',
                lengthMenu: [10, 25, 50,100],
                order: [ 0, "asc" ],
                language: {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading ...'
                },
                ajax: {
                    url: '{{ route('product_part.deleted_list') }}',
                    type: 'get',
                    dataType: 'JSON',
                    cache: false,
                },
                columns: datatable_columns,
                search: {
                    "regex": true
                },
                columnDefs: datatable_columns_defs,
            });
        @endif
    </script>

    @include('components.delete_script')

@endpush