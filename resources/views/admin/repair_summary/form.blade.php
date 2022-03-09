<div id="vue" class="row mb-3">

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
        <label for="type_id" class="form-label">@lang('type.type')</label>
        <div class="form-group">
            {{ Form::select('type_id', $types, null, ['class' => $error_class.'form-control select2vue type_id', 'placeholder' => trans('common.select'), 'id' => 'type_id', 'required' => false, 'onchange' => 'SelectChange("'.route('get_categories_by_type').'","category_id",this)']) }}
            @if ($errors->has('type_id'))
                <p class="text-danger">{{$errors->first('type_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
        <label for="category_id" class="form-label">@lang('category.category')</label>
        <div class="form-group">
            {{ Form::select('category_id', $categories, null, ['class' => $error_class.'form-control select2vue category_id', 'placeholder' => trans('common.select'), 'id' => 'category_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","product_id",this,"model_id")']) }}
            @if ($errors->has('category_id'))
                <p class="text-danger">{{$errors->first('category_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('brand_id') ? 'parsley-error ' : ''; @endphp
        <label for="brand_id" class="form-label">@lang('brand.brand')</label>
        <div class="form-group">
            {{ Form::select('brand_id', $brands, null, ['class' => $error_class.'form-control select2vue brand_id', 'placeholder' => trans('common.select'), 'id' => 'brand_id', 'required' => false, 'onchange' => 'SelectChange("'.route('get_models').'","model_id",this)']) }}
            @if ($errors->has('brand_id'))
                <p class="text-danger">{{$errors->first('brand_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('model_id') ? 'parsley-error ' : ''; @endphp
        <label for="model_id" class="form-label">@lang('model.model')</label>
        <div class="form-group">
            {{ Form::select('model_id', $models, null, ['class' => $error_class.'form-control select2vue model_id', 'placeholder' => trans('common.select'), 'id' => 'model_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","product_id",this,"category_id")']) }}
            @if ($errors->has('model_id'))
                <p class="text-danger">{{$errors->first('model_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('product_id') ? 'parsley-error ' : ''; @endphp
        <label for="product_id" class="form-label">@lang('product.product')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group text-uppercase">
            {{ Form::select('product_id', $products, null, ['class' => $error_class.'form-control select2vue product_id', 'placeholder' => trans('common.select'), 'id' => 'product_id', 'required' => 1]) }}
            @if ($errors->has('product_id'))
                <p class="text-danger">{{$errors->first('product_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('registration_number') ? 'parsley-error ' : ''; @endphp
        <label for="registration_number" class="form-label">@lang('repair_summary.registration_divisional_number')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('registration_number', $product_registration_numbers, @$product_id, ['class' => $error_class.'form-control select2vue registration_number', 'placeholder' => trans('common.select'), 'id' => 'registration_number', 'required' => false]) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                            $error_class = $errors->has('job_number') ? 'parsley-error ' : ''; @endphp
        <label for="job_number" class="form-label">@lang('repair_summary.job_number',['model' => trans('repair_summary.repair_summary')])</label>
        <div class="form-group">
            {{ Form::text('job_number', null, ['class' => $error_class.'form-control', 'placeholder' => trans('repair_summary.job_number'), 'id' => 'job_number', 'required' => false]) }}
            @if ($errors->has('job_number'))
                <p class="text-danger">{{$errors->first('job_number')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                            $error_class = $errors->has('in_date') ? 'parsley-error ' : ''; @endphp
        <label for="in_date" class="form-label">@lang('repair_summary.in_date')</label>
        <div class="form-group">
            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy"  class="{{$error_class}} form-control" name="in_date" id="in_date" value="{{@$repair_summary->in_date}}">
            @if ($errors->has('in_date'))
                <p class="text-danger">{{$errors->first('in_date')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                            $error_class = $errors->has('in_mileage') ? 'parsley-error ' : ''; @endphp
        <label for="in_mileage" class="form-label">@lang('repair_summary.in_mileage',['model' => trans('repair_summary.repair_summary')])</label>
        <div class="form-group">
            {{ Form::text('in_mileage', null, ['class' => $error_class.'form-control', 'id' => 'in_mileage', 'required' => false]) }}
            @if ($errors->has('in_mileage'))
                <p class="text-danger">{{$errors->first('in_mileage')}}</p>
            @endif
        </div>
    </div>
{{--@dd($repair_summary)--}}
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                            $error_class = $errors->has('out_date') ? 'parsley-error ' : ''; @endphp
        <label for="out_date" class="form-label">@lang('repair_summary.out_date')</label>
        <div class="form-group">
            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy"  class="{{$error_class}} form-control" name="out_date" id="out_date" value="{{@$repair_summary->out_date}}">
            @if ($errors->has('out_date'))
                <p class="text-danger">{{$errors->first('out_date')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                            $error_class = $errors->has('out_mileage') ? 'parsley-error ' : ''; @endphp
        <label for="out_mileage" class="form-label">@lang('repair_summary.out_mileage',['model' => trans('repair_summary.repair_summary')])</label>
        <div class="form-group">
            {{ Form::text('out_mileage', null, ['class' => $error_class.'form-control', 'placeholder' => trans('repair_summary.out_mileage'), 'id' => 'out_mileage', 'required' => false]) }}
            @if ($errors->has('out_mileage'))
                <p class="text-danger">{{$errors->first('out_mileage')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('workshop_employee_id') ? 'parsley-error ' : ''; @endphp
        <label for="workshop_employee_id" class="form-label">@lang('repair_summary.workshop_employee')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('workshop_employee_id', $employees, null, ['class' => $error_class.'form-control select2vue workshop_employee_id', 'placeholder' => trans('common.select'),  'required' => 1]) }}
            @if ($errors->has('workshop_employee_id'))
                <p class="text-danger">{{$errors->first('workshop_employee_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('repair_summary.repair_summary')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('repair_summary.repair_summary')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('repair_summary.repair_summary')])
                </label>
            </div>
            @if ($errors->has('status'))
                <p class="text-danger">{{$errors->first('status')}}</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <hr>
        <h6 class="font-weight-semibold">@lang('repair_summary.repair')</h6>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="70%">@lang('repair_summary.repair_details')</th>
                        <th width="20%">@lang('repair_summary.quantity')</th>
                        <th width="5%"></th>
                    </tr>
                    </thead>
                    <tbody class="fault_tbody">
                    <tr class="fault_tr" v-for="(row,index) in repair_summary_detail_inputs">
                        <td lang="bang" class="font-size-18 text-center">
                            @{{index+1}}
                        </td>
                        <td>
                            <input v-model="row.repair_details" class="{{$error_class}} form-control" :name="'repair_summary_details['+index+'][repair_details]'">
                        </td>
                        <td>
                            <input v-model="row.quantity" class="{{$error_class}} form-control" :name="'repair_summary_details['+index+'][quantity]'">
                        </td>
                        <td>
                            <button v-if="index != 0" type="button" class="btn btn-danger float-end" @click="removeRepairSummaryDetails(index)"><i class="fas fa-times text-warning"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-right">
                <a href="javascript:" class="btn btn-outline-success" @click="addMoreRepairSummaryDetails">
                    <i class="fa fa-plus-circle"></i>
                    @lang('repair_summary.repair_add_more')
                </a>
            </div>
        </div>
    </div>

</div>
{{--<div class="row">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('workshop_employee_signature') ? 'parsley-error ' : ''; @endphp
        <label for="workshop_employee_signature" class="form-label">@lang('repair_summary.workshop_employee_signature')</label>
        <div class="form-group">
            {{ Form::file('workshop_employee_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'workshop_employee_signature', 'onchange' => "preview_workshop_employee_signature(this)",  'accept' => "workshop_employee_signature/*"]) }}
            @if ($errors->has('workshop_employee_signature'))
                <p class="text-danger">{{$errors->first('workshop_employee_signature')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        <label class="col-form-label" for="workshop_employee_signature">@lang('repair_summary.workshop_employee_signature_preview')</label><br>
        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="workshop_employee_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">
    </div>

    @if(Request::segment(4) == 'edit')
        <div class="col-sm-12 col-md-4 my-2">
            <label class="col-form-label">
                @lang('repair_summary.workshop_employee_signature_existing')
                {{ Form::checkbox('remove_workshop_employee_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_workshop_employee_signature']) }}
                <label for="remove_workshop_employee_signature" class="form-label">@lang('repair_summary.remove_workshop_employee_signature')</label>
            </label><br>
            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($repair_summary->workshop_employee_signature->source ?? '')}}" alt="@lang('repair_summary.workshop_employee_signature_existing')">
        </div>
    @endif
</div>--}}
<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('repair_summary.repair_summary')])
        </button>
    </div>
</div>

@if(!request()->ajax()) @section('script') @endif
<script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>

<script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
<script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>

<script>
    /*//profile_picture preview
    function preview_workshop_employee_signature(input){
        let file = $("#workshop_employee_signature").get(0).files[0];

        if(file){
            let reader = new FileReader();

            reader.onload = function(){
                $("#workshop_employee_signature_preview").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }*/

    $(function () {
        let vue = new Vue({
            el: '#vue',
            data: {
                workshop_employees:{!! @$employees !!},
                repair_summary_detail_inputs: [{
                    repair_details:'',
                    quantity:'',
                }],
            },
            methods: {
                addMoreRepairSummaryDetails(){
                    this.repair_summary_detail_inputs.push({
                        repair_details:'',
                        quantity:'',
                    });
                },
                removeRepairSummaryDetails(index) {
                    this.repair_summary_detail_inputs.splice(index, 1);
                },
                load_parameters(){
                    console.log({!! @$repair_summary->repairSummaryDetails !!})
                    this.repair_summary_detail_inputs = {!! @$repair_summary->repairSummaryDetails ?? '{}' !!}
                },
            },
            created() {
                @if(\Route::currentRouteName() == 'repair_summary.edit')
                    this.load_parameters()
                @endif
            },
            mounted() {
                $(document).trigger('vue-loaded');
            },
            updated() {
                $(document).trigger('vue-loaded');
                make_bangla()
            },
        });

        $('#product_id').on('change', function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: '{{route('find_product')}}',
                type: 'post',
                dataType: 'JSON',
                data : {id: $('#product_id').val()},
                cache: false,
                success: function (response) {
                    console.log(response)
                    $('#type_id').val(response.type_id)
                    $('#category_id').val(response.category_id)
                    $('#brand_id').val(response.brand_id)
                    $('#model_id').val(response.model_id)

                    $('#registration_number').val(response.id)

                    $('.select2vue').select2()

                    setTimeout(function(){
                        $('#loader').hide();
                    }, 280);
                },
                error: function (xhr) {
                    setTimeout(function(){
                        $('#loader').hide();
                    }, 280);
                }
            });
        })
        $('#registration_number').on('change', function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: '{{route('find_product')}}',
                type: 'post',
                dataType: 'JSON',
                data : {id: $('#registration_number').val()},
                cache: false,
                success: function (response) {
                    console.log(response)
                    $('#type_id').val(response.type_id)
                    $('#category_id').val(response.category_id)
                    $('#brand_id').val(response.brand_id)
                    $('#model_id').val(response.model_id)

                    $('#product_id').val(response.id)

                    $('.select2vue').select2()

                    setTimeout(function(){
                        $('#loader').hide();
                    }, 280);
                },
                error: function (xhr) {
                    setTimeout(function(){
                        $('#loader').hide();
                    }, 280);
                }
            });
        })
    })

    $(document).on('submit', '.repair_summary_submit', function (event) {
        $('#loader').show();
        event.preventDefault();
        let data = $(this).serialize();
        console.log('Hello from ajax submit');

        /*------Remove previous validation messages------*/
        $('input').next().remove('.ajax-error');
        $('select').next().remove('.ajax-error');
        $('textarea').next().remove('.ajax-error');


        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            data: data,

            success: function (response) {
                console.log(response)
                /*------Success redirects to show page------*/
                window.location.href = response.url;
            },
            error: function (xhr, status, exception) {
                setTimeout(function(){
                    $('#loader').hide();
                }, 280);
                console.log(xhr.responseJSON)

                if (exception === 'Bad Request'){
                    console.log(xhr.responseJSON.errors)

                    toastr.error("Something Wrong! Try Again Please!", {
                        closeButton: true,
                        progressBar: true,
                    });

                } else {
                    var errors = Object.entries(xhr.responseJSON.errors);
                    console.log(errors)

                    /*------Validation Messages------*/
                    for(const [index, error] of errors.entries()){

                        if (error[0].includes('repair_summary_details.')){
                            const splited = error[0].split(".");

                            if (splited.length > 1){

                                const error_formatted = '\''+splited[0]+'['+parseInt(splited[1])+']['+splited[2]+']'+'\'';

                                if (index === 0){
                                    $('html, body').animate({
                                        scrollTop: $('input[name='+error_formatted+'], select[name='+error_formatted+'], textarea[name='+error_formatted+']').offset().top - 200
                                    }, 500);
                                }

                                const input2 = $('input[name=' + error_formatted + ']');
                                input2.addClass('is-invalid')
                                input2.after(
                                    '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                                );

                                const select2 = $('select[name=' + error_formatted + ']');
                                select2.addClass('is-invalid')
                                select2.after(
                                    '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                                );

                                const textarea2 = $('textarea[name=' + error_formatted + ']');
                                textarea2.addClass('is-invalid')
                                textarea2.after(
                                    '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                                );

                                toastr.error(error[1], {
                                    closeButton: true,
                                    progressBar: true,
                                });

                            }
                        } else {

                            if (index === 0){
                                $('html, body').animate({
                                    scrollTop: $('input[name='+error[0]+'], select[name='+error[0]+'], textarea[name='+error[0]+']').offset().top - 200
                                }, 500);
                            }

                            const input = $('input[name='+error[0]+']');
                            input.addClass('is-invalid')
                            input.after(
                                '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                            );

                            const select = $('select[name='+error[0]+']');
                            select.addClass('is-invalid')
                            select.after(
                                '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                            );

                            const textarea = $('textarea[name='+error[0]+']');
                            textarea.addClass('is-invalid')
                            textarea.after(
                                '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                            );

                            toastr.error(error[1], {
                                closeButton: true,
                                progressBar: true,
                            });
                        }
                    }
                }
            }
        });
    });

</script>

@include('admin.layouts.partial.footer.vue_loaded_script')

@if(!request()->ajax()) @endsection @endif
