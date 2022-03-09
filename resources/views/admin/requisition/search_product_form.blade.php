<style>
    table.product_info td {
        position: relative;
    }
    table.product_info td input {
        position: absolute;
        display: block;
        top:0;
        left:0;
        margin: 0;
        height: 100%;
        width: 100%;
        border: none;
        padding: 10px;
        box-sizing: border-box;
    }
    /* table.product_info tr td:first-child{
        width: 15%;
        font-weight: 600;
    }
    table.product_info tr td:nth-child(2){
        width: 35%;
    }
    table.product_info tr td:nth-child(3){
        width: 15%;
        font-weight: 600;
    }
    table.product_info tr td:nth-child(4){
        width: 35%;
    } */
</style>
<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            {{ Form::open(['url' => route('requisition.get_product_by_inspection_tracking_number'), 'method' => 'post','class' => 'custom-validation requisition_submit','id' => 'get_product_form','enctype' => "multipart/form-data"]) }}
                <div class="row">
                    <div class="col-md-6">
                        @php $error_class = $errors->has('inspection_tracking_number') ? 'parsley-error ' : ''; @endphp
                        <label for="inspection_tracking_number" class="form-label">@lang('requisition.inspection_tracking_number')</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            {{ Form::select('inspection_tracking_number', $inspection_tracking_numbers, null, ['class' => $error_class.'form-control select2vue inspection_tracking_number', 'placeholder' => trans('common.select'), 'id' => 'inspection_tracking_number', 'required' => false]) }}
                            @if ($errors->has('inspection_tracking_number'))
                                <p class="text-danger">{{$errors->first('inspection_tracking_number')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-top: 27px;">
                        <button type="submit" class="btn btn-md btn-primary waves-effect waves-light">
                            <i class="fa fa-search"></i> @lang('requisition.btn_search')
                        </button>
                    </div>
                </div>
            {{ Form::close() }}

            <div class="mt-2" id="product_details" style="display: none;">
                <table class="table table-bordered table-hover product_info">
                <thead>
                    <th>@lang('requisition.tracking_no')</th>
                    <th>@lang('requisition.name')</th>
                    <th>@lang('requisition.bn_name')</th>
                    <th>@lang('type.type')</th>
                    <th>@lang('category.category')</th>
                    <th>@lang('model.brand')</th>
                    <th>@lang('model.model')</th>
                    <th>@lang('requisition.fire_station')</th>
                    <th>@lang('requisition.registration_number')</th>
                </thead>
                <tbody id="product_information">
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@if(!request()->ajax()) @section('script') @endif
<script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>

<script>
    $(document).on('submit', '#get_product_form', function (event) {
        $('#loader').show();
        event.preventDefault();
        let inspection_tracking_number = $('#inspection_tracking_number').val()
        let ajax_error_alert = $('#ajax_error_alert')
        let ajax_error = ajax_error_alert.find('#ajax_error')
        ajax_error.text('')
        ajax_error_alert.addClass('d-none');
        let vm = $(this)
        let input_array = ['input', 'select']
        vm.find('.parsley-errors-list').remove();
        input_array.forEach(function (value, index) {
            vm.find(value).removeClass('parsley-error');
        });
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            data: {
                "inspection_tracking_number": inspection_tracking_number
            },
            success:function(response) {
                $('#product_information').html('');
                for(item of response){
                    $('#loader').hide();
                    $('#product_information').append(`<tr><td>${ item.tracking_no }</td><td>${ item.name }</td><td>${ item.bn_name }</td><td>${ item.type.bn_name }</td><td>${ item.category.bn_name }</td><td>${ item.brand.bn_name }</td><td>${ item.model.bn_name }</td><td>${ item.fire_station.bn_name }</td><td>${ item.registration_number }</td></tr>`);
                    $('#product_details').show();
                }
            },
            error: function (xhr) {
                ajax_error_alert.removeClass('d-none');
                if(xhr.status == 500 && xhr.responseJSON){
                    ajax_error.text(xhr.responseJSON);
                }
                if(xhr.responseJSON && xhr.responseJSON.exception){
                    ajax_error.text(xhr.responseJSON.message);
                }
                if(xhr.responseJSON && xhr.responseJSON.errors){
                    let errors = Object.entries(xhr.responseJSON.errors);
                    for(let error of errors){
                        ajax_error.text(error[1]);
                        break
                    }
                    let flag = 0;
                    for(let error of errors){
                        input_array.forEach(function (value, index) {
                            let input = $(value+'[name='+error[0]+']');
                            vm.find(input).addClass('parsley-error');
                            vm.find(input).after(
                                '<ul class="parsley-errors-list filled" aria-hidden="false">' +
                                '<li class="parsley-required">'+error[1]+'</li>' +
                                '</ul>'
                            );
                        });
                    }
                }
                setTimeout(function(){
                    $('#loader').hide();
                }, 280);
            }
        })

    });
</script>

@include('admin.layouts.partial.footer.vue_loaded_script')

@if(!request()->ajax()) @endsection @endif
