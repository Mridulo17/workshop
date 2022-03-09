@extends('admin.layouts.master')

@section('title') @lang('division.index_title') @endsection

@section('css')

@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('title')@lang('division.index_title')@endslot
        @slot('create_button')
            <a href="{{route('division.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">
                <i class="fa fa-plus-circle"></i> @lang('division.create_button_title')
            </a>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>@lang('division.label_name')</th>
                                <th>@lang('division.label_bn_name')</th>
                                <th width="5%">@lang('division.label_status')</th>
                                <th width="12%">@lang('division.label_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection

@section('script')
    {{--yajra datatable--}}
    <script type="text/javascript">
        var updateThis ;
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
                url: '{{ route('division.index') }}',
                type: 'get',
                dataType: 'JSON',
                cache: false,
            },
            columns: [
                {data: 'DT_RowIndex',name:"DT_RowIndex", orderable: false, searchable: false},
                {data: 'name',name: 'name',},
                {data: 'bn_name',name: 'bn_name',},
                {data: 'status',name: 'status',},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            search: {
                "regex": true
            },
            columnDefs: [
                {'bSortable': true, 'aTargets': [0,1,2,3]},
                {'bSearchable': false, 'aTargets': [0]},
                { className: 'text-center', targets: [0,3,4] },
            ],
        });
    </script>

    @include('components.delete_script')

@endsection
