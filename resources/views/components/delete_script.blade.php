{{-- code for destroy --}}
<script type="text/javascript">
    $('table tbody').on( 'click', '.destroy', function () {
        event.preventDefault();
        let url = $(this).attr('href')
        let tr = $(this).parent().parent();

        if ($('#deleted_btn_tab').hasClass('active')){
            permanently_delete_function(url,tr)
        } else {
            delete_function(url,tr)
        }

    });

    function delete_function(URL,TR) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: "@lang('common.are_you_sure')",
            text: "@lang('common.will_find_in_deleted_list')",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "@lang('common.yes_delete')",
            cancelButtonText: "@lang('common.no_cancel')",
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
                    url: URL,
                    type: 'DELETE',
                    dataType: 'JSON',
                    cache: false,
                    success: function (response) {
                        toastr["success"](response.message, "@lang('common.delete_success')");
                        TR.remove();
                    },
                    error: function (xhr) {
                        toastr["error"]("@lang('common.not_deleted')", "@lang('common.sorry')");
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                toastr["error"]("@lang('common.safe')", "@lang('common.cancelled')");
            }
        })
    }

    function permanently_delete_function(URL,TR) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: "@lang('common.are_you_sure')",
            text: "@lang('common.you_wont_be_able_to_recover_this')",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "@lang('common.yes_delete_permanently')",
            cancelButtonText: "@lang('common.no_cancel')",
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
                    url: URL,
                    type: 'DELETE',
                    dataType: 'JSON',
                    cache: false,
                    success: function (response) {
                        toastr["success"](response.message, "@lang('common.deleted_permanently')");
                        TR.remove();
                    },
                    error: function (xhr) {
                        toastr["error"]("@lang('common.not_deleted')", "@lang('common.sorry')");
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                toastr["error"]("@lang('common.safe')", "@lang('common.cancelled')");
            }
        })
    }
</script>

@include('components.tab_view_script')
@include('components.restore_script')
