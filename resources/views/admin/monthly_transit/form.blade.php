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
            {{ Form::select('category_id', $categories, null, ['class' => $error_class.'form-control select2vue category_id', 'placeholder' => trans('common.select'), 'id' => 'category_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","employee_id",this,"model_id")']) }}
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
        <label for="registration_number" class="form-label">@lang('inspection_report.registration_divisional_number')
        </label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('registration_number', $product_registration_numbers, @$product_id, ['class' =>
            $error_class.'form-control select2vue registration_number', 'placeholder' =>
            trans('common.select'), 'id' => 'registration_number', 'required' =>
            false]) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <hr>
        <h6 class="font-weight-semibold">@lang('monthly_transit.monthly_transit_details')</h6>
        <div v-for="(row,index) in monthly_transit_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">
                <div class="col-sm-12">
                    <h5><span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{index+1}}</span></h5>
                </div>
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm" @click="removeMonthlyTransitDetails(index)"><i class="fas fa-times text-warning"></i> </button>
                </div>
                <div class="row" >
                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('month') ? 'parsley-error ' : ''; @endphp
                        <label for="month" class="form-label">@lang('monthly_transit.month',['model' => trans('monthly_transit.monthly_transit')])</label>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue month" :name="'monthly_transit_details['+index+'][month]'">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(month,key) in months" :value="key" :selected="key == row.month">@{{month}}</option>

                            </select>
                            @if ($errors->has('month'))
                                <p class="text-danger">{{$errors->first('month')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('kmpl_lph_per_month') ? 'parsley-error ' : ''; @endphp
                        <label for="kmpl_lph_per_month" class="form-label">@lang('monthly_transit.kmpl_lph_per_month',['model' => trans('monthly_transit.monthly_transit')])</label>
                        <div class="form-group">
                            <input v-model="row.kmpl_lph_per_month" class="{{$error_class}} form-control" :name="'monthly_transit_details['+index+'][kmpl_lph_per_month]'" id="kmpl_lph_per_month">
                            @if ($errors->has('kmpl_lph_per_month'))
                                <p class="text-danger">{{$errors->first('kmpl_lph_per_month')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('fuel_cost') ? 'parsley-error ' : ''; @endphp
                        <label for="fuel_cost" class="form-label">@lang('monthly_transit.fuel_cost',['model' => trans('monthly_transit.monthly_transit')])</label>
                        <div class="form-group">
                            <input v-model="row.fuel_cost" class="{{$error_class}} form-control" :name="'monthly_transit_details['+index+'][fuel_cost]'" id="fuel_cost">
                            @if ($errors->has('fuel_cost'))
                                <p class="text-danger">{{$errors->first('fuel_cost')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('lubricant_cost') ? 'parsley-error ' : ''; @endphp
                        <label for="lubricant_cost" class="form-label">@lang('monthly_transit.lubricant_cost',['model' => trans('monthly_transit.monthly_transit')])</label>
                        <div class="form-group">
                            <input v-model="row.lubricant_cost" class="{{$error_class}} form-control" :name="'monthly_transit_details['+index+'][lubricant_cost]'" id="lubricant_cost">
                            @if ($errors->has('lubricant_cost'))
                                <p class="text-danger">{{$errors->first('lubricant_cost')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('kmpl_lph_per_liter') ? 'parsley-error ' : ''; @endphp
                        <label for="kmpl_lph_per_liter" class="form-label">@lang('monthly_transit.kmpl_lph_per_liter',['model' => trans('monthly_transit.monthly_transit')])</label>
                        <div class="form-group">
                            <input v-model="row.kmpl_lph_per_liter" class="{{$error_class}} form-control" :name="'monthly_transit_details['+index+'][kmpl_lph_per_liter]'" id="kmpl_lph_per_liter">
                            @if ($errors->has('kmpl_lph_per_liter'))
                                <p class="text-danger">{{$errors->first('kmpl_lph_per_liter')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('sso_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="sso_employee_id" class="form-label">@lang('common.model',['model' => trans('monthly_transit.sso_employee_id')])</label>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue sso_employee_id" :name="'monthly_transit_details['+index+'][sso_employee_id]'">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(employee,index) in employees" :value="index" :selected="index == row.sso_employee_id">@{{employee}}</option>
                            </select>
                            @if ($errors->has('sso_employee_id'))
                                <p class="text-danger">{{$errors->first('sso_employee_id')}}</p>
                            @endif
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-sm-12 text-right">
            <a href="javascript:" class="btn btn-success"  @click="addMoreMonthlyTransitDetails">
                <i class="fa fa-plus-circle"></i>
                @lang('monthly_transit.add_monthly_transit')
            </a>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('monthly_transit.monthly_transit')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('monthly_transit.monthly_transit')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('monthly_transit.monthly_transit')])
                </label>
            </div>
            @if ($errors->has('status'))
                <p class="text-danger">{{$errors->first('status')}}</p>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('monthly_transit.monthly_transit')])
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
    function preview_examinor_signature(input){
        let file = $("#examinor_signature").get(0).files[0];

        if(file){
            let reader = new FileReader();

            reader.onload = function(){
                $("#examinor_signature_preview").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    //profile_picture preview
    function preview_examinor_signature(input){
        let file = $("#examinor_signature").get(0).files[0];

        if(file){
            let reader = new FileReader();

            reader.onload = function(){
                $("#examinor_signature_preview").attr("src", reader.result);
            }
            // reader.readAsDataURL(file);
        }
    }*/

    $(function () {
        let vue = new Vue({
            el: '#vue',
            data: {
                months:{!! @$months !!},
                employees:{!! @$employees !!},
                monthly_transit_inputs: [{
                    month:'',
                    kmpl_lph_per_month:'',
                    fuel_cost:'',
                    lubricant_cost:'',
                    kmpl_lph_per_liter:'',
                }],
            },
            methods: {
                addMoreMonthlyTransitDetails(){
                    this.monthly_transit_inputs.push({
                        month:'',
                        kmpl_lph_per_month:'',
                        fuel_cost:'',
                        lubricant_cost:'',
                        kmpl_lph_per_liter:'',
                    });
                },
                removeMonthlyTransitDetails(index) {
                    this.monthly_transit_inputs.splice(index, 1);
                },
                load_parameters(){
                    {{--console.log({!! @$monthly_transit->monthlyTransitDetails !!})--}}
                    this.monthly_transit_inputs = {!! @$monthly_transit->monthlyTransitDetails ?? '{}' !!}
                },
            },
            created() {
                @if(\Route::currentRouteName() == 'monthly_transit.edit')
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

                    // $('#divisional_number').val(response.divisional_number)
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
    $(document).on('submit', '.monthly_transit_submit', function (event) {
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

                        if (error[0].includes('monthly_transit_details.')){
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
