@extends('admin.layouts.master')

@section('title') @lang('stock_receive.index') @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('title')@lang('stock_receive.index')@endslot
        @slot('create_button')
            <a href="{{route('stock_receive.create')}}" class="btn btn-info btn-sm waves-effect waves-light">
                <i class="fa fa-plus-circle"></i> @lang('common.create',['model' => trans('stock_receive.stock_receive')])
            </a>
        @endslot
    @endcomponent

    @php
        $datatable_thead = '
            <th width="5%">#</th>
            <th>'.trans('stock_receive.tracking_no').'</th>
            <th>'.trans('workshop.workshop').'</th>
            <th>'.trans('fire_station.fire_station').'</th>
            <th>'.trans('supplier.supplier').'</th>
            <th>'.trans('stock_receive.received_date').'</th>
            <th width="12%">'.trans('common.action').'</th>
        '
    @endphp

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
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>@lang('stock_receive.tracking_no')</th>
                                        <th>@lang('workshop.workshop')</th>
                                        <th>@lang('fire_station.fire_station')</th>
                                        <th>@lang('supplier.supplier')</th>
                                        <th>@lang('stock_receive.received_date')</th>
                                        <th width="12%">@lang('common.action')</th>
                                    </tr>
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
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>@lang('stock_receive.tracking_no')</th>
                                        <th>@lang('workshop.workshop')</th>
                                        <th>@lang('fire_station.fire_station')</th>
                                        <th>@lang('supplier.supplier')</th>
                                        <th>@lang('stock_receive.received_date')</th>
                                        <th width="12%">@lang('common.action')</th>
                                    </tr>
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
        var updateThis ;
        let datatable_columns = [
            {data: 'DT_RowIndex',name:"DT_RowIndex", orderable: false, searchable: false},
            {data: 'tracking_no',name: 'tracking_no',},
            {data: 'workshop.bn_name',name: 'workshop.bn_name',defaultContent:''},
            {data: 'fire_station.bn_name',name: 'fire_station.bn_name',defaultContent:''},
            {data: 'supplier.bn_name',name: 'supplier.bn_name',defaultContent : ''},
            {data: 'received_date',name: 'received_date',defaultContent : ''},
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
            { className: 'text-center', targets: [0,5] },
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
                url: '{{ route('stock_receive.index') }}',
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
                    url: '{{ route('stock_receive.deleted_list') }}',
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
