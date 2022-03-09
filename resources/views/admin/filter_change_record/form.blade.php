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
        <label for="registration_number" class="form-label">@lang('filter_change_record.registration_divisional_number')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('registration_number', $product_registration_numbers, @$product_id, ['class' => $error_class
            .'form-control select2vue registration_number', 'placeholder' => trans('common.select'), 'id' =>
            'registration_number', 'required' => false]) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <hr>
        <h6 class="font-weight-semibold">@lang('filter_change_record.filter_change_details')</h6>
        <div v-for="(row,index) in filter_change_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">
                <div class="col-sm-12">
                    <h5><span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{index+1}}</span></h5>
                </div>
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm" @click="removeFilterChange(index)"><i class="fas fa-times text-warning"></i></button>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */
                            $error_class = $errors->has('mobil_filter') ? 'parsley-error ' : ''; @endphp
                        <label for="mobil_filter" class="form-label">@lang('filter_change_record.mobil_filter',['model' => trans('filter_change_record.filter_change_record')])</label>
                        <div class="form-group">
                            <input v-model="row.mobil_filter" class="{{$error_class}} form-control"
                                   :name="'filter_change_details['+index+'][mobil_filter]'">
                            @if ($errors->has('mobil_filter'))
                                <p class="text-danger">{{$errors->first('mobil_filter')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */
                            $error_class = $errors->has('diesel_filter') ? 'parsley-error ' : ''; @endphp
                        <label for="diesel_filter" class="form-label">@lang('filter_change_record.diesel_filter',['model' => trans('filter_change_record.filter_change_record')])</label>
                        <div class="form-group">
                            <input v-model="row.diesel_filter" class="{{$error_class}} form-control"
                                   :name="'filter_change_details['+index+'][diesel_filter]'">
                            @if ($errors->has('diesel_filter'))
                                <p class="text-danger">{{$errors->first('diesel_filter')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */
                            $error_class = $errors->has('air_filter') ? 'parsley-error ' : ''; @endphp
                        <label for="air_filter" class="form-label">@lang('filter_change_record.air_filter',['model' => trans('filter_change_record.filter_change_record')])</label>
                        <div class="form-group">
                            <input v-model="row.air_filter" class="{{$error_class}} form-control"
                                   :name="'filter_change_details['+index+'][air_filter]'">
                            @if ($errors->has('air_filter'))
                                <p class="text-danger">{{$errors->first('air_filter')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */
                            $error_class = $errors->has('change_date') ? 'parsley-error ' : ''; @endphp
                        <label for="change_date" class="form-label">@lang('filter_change_record.change_date')</label>
                        <div class="form-group">
                            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy" v-model="row.change_date" class="{{$error_class}} form-control"
                                   :name="'filter_change_details['+index+'][change_date]'">
                            @if ($errors->has('change_date'))
                                <p class="text-danger">{{$errors->first('change_date')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */
                        $error_class = $errors->has('substitutor_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="substitutor_employee_id" class="form-label">@lang('common.model',['model' => trans('filter_change_record.substituter')])
                        </label>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue substitutor_employee_id"
                                    :name="'filter_change_details['+index+'][substitutor_employee_id]'" >
                                <option value="">@lang('common.select')</option>
                                <option v-for="(employee,index) in employees" :value="index" :selected="index == row.substitutor_employee_id">@{{employee}}</option>
                            </select>
                            @if ($errors->has('substitutor_employee_id'))
                                <p class="text-danger">{{$errors->first('substitutor_employee_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @php /** @var string $errors */
                        $error_class = $errors->has('sso_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="sso_employee_id" class="form-label">@lang('common.model',['model' => trans('filter_change_record.sso')])
                        </label>
                        <div class="form-group">
                            <select  class="{{$error_class}} form-control select2vue sso_employee_id" :name="'filter_change_details['+index+'][sso_employee_id]'" >
                                <option value="">@lang('common.select')</option>
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
            <a href="javascript:" class="btn btn-success"  @click="addMoreFilterChange">
                <i class="fa fa-plus-circle"></i>
                @lang('filter_change_record.filter_change')
            </a>
        </div>
    </div>


    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('filter_change_record.filter_change_record')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('filter_change_record.filter_change_record')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('filter_change_record.filter_change_record')])
                </label>
            </div>
            @if ($errors->has('status'))
                <p class="text-danger">{{$errors->first('status')}}</p>
            @endif
        </div>
    </div>
</div>
{{--<div class="row">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('substitutor_signature') ? 'parsley-error ' : ''; @endphp
        <label for="substitutor_signature" class="form-label">@lang('filter_change_record.substitutor_signature')</label>
        <div class="form-group">
            {{ Form::file('substitutor_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'substitutor_signature', 'onchange' => "preview_substitutor_signature(this)",  'accept' => "substitutor_signature/*"]) }}
            @if ($errors->has('substitutor_signature'))
                <p class="text-danger">{{$errors->first('substitutor_signature')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        <label class="col-form-label" for="substitutor_signature">@lang('filter_change_record.substitutor_signature_preview')</label><br>
        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="substitutor_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">
    </div>

    @if(Request::segment(4) == 'edit')
        <div class="col-sm-12 col-md-4 my-2">
            <label class="col-form-label">
                @lang('filter_change_record.substitutor_signature_existing')
                {{ Form::checkbox('remove_substitutor_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_substitutor_signature']) }}
                <label for="remove_substitutor_signature" class="form-label">@lang('filter_change_record.remove_substitutor_signature')</label>
            </label><br>
            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($filter_change_record->substitutor_signature->source ?? '')}}" alt="@lang('filter_change_record.substitutor_signature_existing')">
        </div>
    @endif
</div>
<div class="row">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('sso_signature') ? 'parsley-error ' : ''; @endphp
        <label for="sso_signature" class="form-label">@lang('filter_change_record.sso_signature')</label>
        <div class="form-group">
            {{ Form::file('sso_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'sso_signature', 'onchange' => "preview_sso_signature(this)",  'accept' => "sso_signature/*"]) }}
            @if ($errors->has('sso_signature'))
                <p class="text-danger">{{$errors->first('sso_signature')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        <label class="col-form-label" for="sso_signature">@lang('filter_change_record.sso_signature_preview')</label><br>
        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="sso_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">
    </div>

    @if(Request::segment(4) == 'edit')
        <div class="col-sm-12 col-md-4 my-2">
            <label class="col-form-label">
                @lang('filter_change_record.sso_signature_existing')
                {{ Form::checkbox('remove_sso_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_sso_signature']) }}
                <label for="remove_sso_signature" class="form-label">@lang('filter_change_record.remove_sso_signature')</label>
            </label><br>
            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($filter_change_record->sso_signature->source ?? '')}}" alt="@lang('filter_change_record.sso_signature_existing')">
        </div>
    @endif
</div>--}}
<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('filter_change_record.filter_change_record')])
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
    function preview_substitutor_signature(input){
        let file = $("#substitutor_signature").get(0).files[0];

        if(file){
            let reader = new FileReader();

            reader.onload = function(){
                $("#substitutor_signature_preview").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    //profile_picture preview
    function preview_substitutor_signature(input){
        let file = $("#substitutor_signature").get(0).files[0];

        if(file){
            let reader = new FileReader();

            reader.onload = function(){
                $("#substitutor_signature_preview").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }*/

    $(function () {
        let vue = new Vue({
            el: '#vue',
            data: {
                employees:{!! @$employees !!},
                filter_change_inputs: [{
                    mobil_filter:'',
                    diesel_filter:'',
                    air_filter:'',
                    change_date:'',
                }],
            },
            methods: {
                addMoreFilterChange(){
                    this.filter_change_inputs.push({
                        mobil_filter:'',
                        diesel_filter:'',
                        air_filter:'',
                        change_date:'',
                    });
                },
                removeFilterChange(index) {
                    this.filter_change_inputs.splice(index, 1);
                },
                load_parameters(){
                    console.log({!! @$filter_change_record->filterChangeDetails !!})
                    this.filter_change_inputs = {!! @$filter_change_record->filterChangeDetails ?? '{}' !!}
                },
            },
            created() {
                @if(\Route::currentRouteName() == 'filter_change_record.edit')
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

    $(document).on('submit', '.filter_change_submit', function (event) {
        $('#loader').show();
        event.preventDefault();
        let data = $(this).serialize();

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

                        if (error[0].includes('filter_change_details.')){
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
