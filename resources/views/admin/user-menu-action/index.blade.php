@extends('admin.layouts.master')

@section('title') @lang('user_menu_action/attribute.index_title') @endsection

@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')@lang('user_menu_action/attribute.index_title') ( {{$menu->name}} )@endslot
        @slot('create_button')
            <a href="{{route('user_menu_action.create',$menu->id)}}" class="btn btn-primary btn-sm waves-effect waves-light">
                <i class="fa fa-plus-circle"></i> @lang('user_menu_action/attribute.create_button_title')
            </a>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="datatable" class="table table-bordered table-striped table-hover dt-responsive  nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>Parent Menu</th>
                                <th>Name</th>
                                <th>Route Name</th>
                                <th>Type</th>
                                <th>Slug</th>
                                <th width="110px">Order</th>
                                <th width="110px">Status</th>
                                <th width="150px">Action</th>
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
            order: [ 5, "asc" ],
            language: {
                'loadingRecords': '&nbsp;',
                'processing': 'Loading ...'
            },
            ajax: {
                url: '{{ route('user_menu_action.index',$menu->id) }}',
                type: 'get',
                dataType: 'JSON',
                cache: false,
            },
            columns: [
                {data: 'parent_menu',name: 'parent_menu',},
                {data: 'name',name: 'name',},
                {data: 'route_name',name: 'route_name',},
                {data: 'type_name',name: 'type_name',},
                {data: 'slug',name: 'slug',},
                {data: 'order_by',name: 'order_by',},
                {data: 'status',name: 'status',},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ],
              columnDefs: [
                { className: 'text-center', targets: [0,3,4,5] },
              ],
        });
    </script>

    {{-- code for destroy --}}
    <script type="text/javascript">
        $('table tbody').on( 'click', '.destroy', function () {
            event.preventDefault();
            var tr = $(this).parent().parent();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure ?',
                text: "You won't be able to recover this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it !',
                cancelButtonText: 'No, cancel !',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: $(this).attr('href'),
                        type: 'DELETE',
                        dataType: 'JSON',
                        cache: false,
                        success: function (response) {
                            toastr["success"](response.message, "Delete");
                            tr.remove();
                        },
                        error: function (xhr) {
                            toastr["error"]('Data not deleted', "Sorry");
                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    toastr["error"]('Your data is safe ', "Cancelled");

                }
            })
        });
    </script>
@endsection
