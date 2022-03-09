@extends('admin.layouts.master')

@section('title') @lang('common.index',['model' => trans('driver_assign.driver_assign')]) @endsection

@section('css')

@endsection

@section('thead')
    <tr>
        <th width="5%">#</th>
        <th>@lang('driver_assign.employee_workshop')</th>
        <th>@lang('driver_assign.employee_fire_station')</th>
        <th>@lang('common.model',['model' => trans('driver.driver')])</th>
        <th>@lang('driver_assign.employee_old_pin')</th>
        <th>@lang('driver_assign.employee_new_pin')</th>
        <th>@lang('driver_assign.vehicle')</th>
        <th width="5%">@lang('common.status')</th>
        <th width="12%">@lang('common.action')</th>
    </tr>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('title')@lang('common.index',['model' => trans('driver_assign.driver_assign')])@endslot
        @slot('create_button')
            <a href="{{route('driver_assign.create')}}" class="btn btn-primary btn-sm waves-effect waves-light modal_lg_button">
                <i class="fa fa-plus-circle"></i> @lang('common.create',['model' => trans('driver_assign.driver_assign')])
            </a>
        @endslot
    @endcomponent

    <ul class="nav nav-tabs" id="Tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-primary" id="all_btn_tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">@lang('common.index_list',['model' => trans('driver_assign.driver_assign')])</button>
        </li>
        @if(\App\Helpers\MenuHelper::CustomElementPermission('deleted_list'))
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary" id="deleted_btn_tab" data-bs-toggle="tab" data-bs-target="#deleted_list" type="button" role="tab" aria-controls="deleted_list" aria-selected="false">@lang('common.deleted_list',['model' => trans('driver_assign.driver_assign')])</button>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="TabContent">
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
                </div> <!-- end col -->
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
                </div> <!-- end col -->
            </div>
        </div>
    </div>

@endsection

@include('components.modal_lg')

@section('script')
    <script type="text/javascript">
        let datatable_columns = [
                {data: 'DT_RowIndex',name:"DT_RowIndex", orderable: false, searchable: false},
                {data: 'driver.employee.workshop.bn_name',name: 'driver.employee.workshop.bn_name',},
                {data: 'driver.employee.fire_station.bn_name',name: 'driver.employee.fire_station.bn_name',},
                {data: 'driver.employee.bn_name',name: 'driver.employee.bn_name',},
                {data: 'driver.employee.old_pin',name: 'driver.employee.old_pin',},
                {data: 'driver.employee.new_pin',name: 'driver.employee.new_pin',},
                {data: 'product.tracking_no',name: 'product.tracking_no',},
                {data: 'status',name: 'status',},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ];

        let datatable_columns_defs = [
                {'bSortable': true, 'aTargets': [0,1,2,3,4]},
                {'bSearchable': false, 'aTargets': [0]},
                { className: 'text-center', targets: [0,3,4] },
                { className: 'text-uppercase', targets: [6] },
            ];

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
                url: '{{ route('driver_assign.index') }}',
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
                    url: '{{ route('driver_assign.deleted_list') }}',
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
@endsection
