@extends('admin.layouts.master')

@section('title') @lang('thana.index_title') @endsection

@section('css')

@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('title')@lang('thana.index_title')@endslot
        @slot('create_button')
            <a href="{{route('thana.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">
                <i class="fa fa-plus-circle"></i> @lang('thana.create_button_title')
            </a>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">

                    <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>@lang('division.division')</th>
                                <th>@lang('district.district')</th>
                                <th>@lang('thana.label_name')</th>
                                <th>@lang('thana.label_bn_name')</th>
                                <th width="5%">@lang('thana.label_status')</th>
                                <th width="12%">@lang('thana.label_action')</th>
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
                url: '{{ route('thana.index') }}',
                type: 'get',
                dataType: 'JSON',
                cache: false,
            },
            columns: [
                {data: 'DT_RowIndex',name:"DT_RowIndex", orderable: false, searchable: false},
                {data: 'division_name',name: 'division_name', defaultContent: ''},
                {data: 'district_name',name: 'district_name', defaultContent: ''},
                {data: 'name',name: 'name', defaultContent: ''},
                {data: 'bn_name',name: 'bn_name', defaultContent: ''},
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
                {'bSortable': true, 'aTargets': [0,1,2,3,4]},
                {'bSearchable': false, 'aTargets': [0]},
                { className: 'text-center', targets: [0,5,6] },
            ],
        });
    </script>

    @include('components.delete_script')

@endsection
