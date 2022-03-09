<script type="text/javascript">
    $('#all_btn_tab').on( 'click', function () {
        if($(this).hasClass('active')){
            $('#datatable').DataTable().ajax.reload();
        }else{

        }
    })

    $('#deleted_btn_tab').on( 'click', function () {
        if($('#all_btn_tab').hasClass('active')){

        }else{
            $('#deleted_list_datatable').DataTable().ajax.reload();
        }
    })
</script>
