@extends('admin.layouts.master')

@section('title') @lang('user.index_title') @endsection

@section('css')
    [data-route~="user.destroy"][data-id~="{{auth()->user()->id}}"] {
        display: none;
    }
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('title')@lang('user.index_title')@endslot
        @slot('create_button')
            <a href="{{route('user.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">
                <i class="fa fa-plus-circle"></i> @lang('user.create_button_title')
            </a>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="datatable" class="table table-bordered table-hover dt-responsive w-100" >
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>@lang('user.label_role_id')</th>
                                <th>@lang('user.label_bn_name')</th>
                                <th>@lang('user.label_email')</th>
                                <th>@lang('user.label_district_id')</th>
                                <th width="5%">@lang('user.label_status')</th>
                                <th width="15%">@lang('user.label_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/common/libs/datatables/datatables.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/common/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script type="text/javascript">
        window.onload = function(e){
            $(".destroy[data-id='{{Auth::user()->id}}']").hide()
        }

        let url = '';
        function clicked(id){
            url = '{{ route("user.index",["type" => '+id+']) }}';
        }

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            serverMethod: 'get',
            lengthMenu: [10, 25, 50,100],
            order: [ 3, "asc" ],
            language: {
                'loadingRecords': '&nbsp;',
                'processing': 'Loading ...'
            },
            ajax: {
                url: url,
                type: 'get',
                dataType: 'JSON',
                cache: false,
            },
            columns: [
                {data: 'DT_RowIndex',name:"DT_RowIndex", orderable: false, searchable: false},
                {data: 'role',name: 'role',},
                {data: 'bn_name',name: 'bn_name',},
                {data: 'email',name: 'email',},
                {data: 'district',name: 'district',},
                {data: 'status',name: 'status',},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                {'bSortable': true, 'aTargets': [0,1,2,3]},
                {'bSearchable': false, 'aTargets': [0]},
                { className: 'text-center', targets: [0,5,6] },
            ],
        });
    </script>

    @include('components.delete_script')

@endsection
