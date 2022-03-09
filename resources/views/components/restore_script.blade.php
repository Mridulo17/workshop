{{-- code for destroy --}}
<script type="text/javascript">
    $('table tbody').on( 'click', '.restore', function () {
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
            title: '@lang('common.are_you_sure_to_restore')',
            /*text: "You won't be able to recover this!",*/
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '@lang('common.yes_restore')',
            cancelButtonText: '@lang('common.no_cancel')',
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
                    type: 'GET',
                    dataType: 'JSON',
                    cache: false,
                    success: function (response) {
                        toastr["success"](response.message, "@lang('common.restore_success')");
                        tr.remove();
                    },
                    error: function (xhr) {
                        toastr["error"]('@lang('common.not_restored')', "@lang('common.sorry')");
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                toastr["error"]('@lang('common.kept_deleted')', "@lang('common.cancelled')");

            }
        })
    });
</script>
