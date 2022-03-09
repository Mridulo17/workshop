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
        <h6 class="font-weight-semibold">@lang('kmpl_lph_record.kmpl_lph_records')</h6>
        <div v-for="(row,index) in kmpl_lph_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">
                <div class="col-sm-12">
                    <h5><span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{index+1}}</span></h5>
                </div>
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm" @click="removeKmpl(index)"><i
                            class="fas fa-times text-warning"></i> </button>
                </div>
                <div class="row" >
                    <div class="col-sm-12 col-md-3 mb-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('examiner_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="examiner_employee_id" class="form-label">@lang('kmpl_lph_record.examiner_employee_id',['model' => trans('kmpl_lph_record.examiner_employee_id')])</label>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue examiner_employee_id"
                                    :name="'kmpl_lph_details['+index+'][examiner_employee_id]'" >
                                <option value="">@lang('common.select')</option>
                                <option v-for="(employee,index) in employees" :value="index" :selected="index == row.examiner_employee_id">@{{employee}}</option>
                            </select>
                            @if ($errors->has('examiner_employee_id'))
                                <p class="text-danger">{{$errors->first('examiner_employee_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 mb-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('examiner_designation_id') ? 'parsley-error ' : ''; @endphp
                        <label for="examiner_designation_id" class="form-label">@lang('kmpl_lph_record.examiner_designation_id',['model' => trans('kmpl_lph_record.kmpl_lph_record')])</label>
                        <div class="form-group">
                            <select :name="'kmpl_lph_details['+index+'][examiner_designation_id]'" class="{{$error_class}} form-control select2vue">
                                <option value="">@lang('common.select')</option>
                                <option v-for="(designation,index) in designations" :value="index" :selected="index == row.examiner_designation_id">@{{designation}}</option>
                            </select>
                            @if ($errors->has('examiner_designation_id'))
                                <p class="text-danger">{{$errors->first('examiner_designation_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 mb-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('result_kmpl') ? 'parsley-error ' : ''; @endphp
                        <label for="result_kmpl" class="form-label">@lang('kmpl_lph_record.result_kmpl',['model' => trans('kmpl_lph_record.kmpl_lph_record')])</label>
                        <div class="form-group">
                            <input v-model="row.result_kmpl" class="{{$error_class}} form-control"
                                   :name="'kmpl_lph_details['+index+'][result_kmpl]'">
                            @if ($errors->has('result_kmpl'))
                                <p class="text-danger">{{$errors->first('result_kmpl')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 mb-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('result_lph') ? 'parsley-error ' : ''; @endphp
                        <label for="result_lph" class="form-label">@lang('kmpl_lph_record.result_lph',['model' => trans('kmpl_lph_record.kmpl_lph_record')])</label>
                        <div class="form-group">
                            <input v-model="row.result_lph" class="{{$error_class}} form-control"
                                   :name="'kmpl_lph_details['+index+'][result_lph]'" id="result_lph">
                            @if ($errors->has('result_lph'))
                                <p class="text-danger">{{$errors->first('result_lph')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 mb-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('exam_date') ? 'parsley-error ' : ''; @endphp
                        <label for="exam_date" class="form-label">@lang('kmpl_lph_record.exam_date',['model' => trans('kmpl_lph_record.kmpl_lph_record')])</label>
                        <div class="form-group">
                            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy" v-model="row.exam_date" class="{{$error_class}} form-control" type="text"
                                   :name="'kmpl_lph_details['+index+'][exam_date]'" id="exam_date">
                            @if ($errors->has('exam_date'))
                                <p class="text-danger">{{$errors->first('exam_date')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-12 text-right">
            <a href="javascript:" class="btn btn-success"  @click="addMoreKmpl">
                <i class="fa fa-plus-circle"></i>
                @lang('kmpl_lph_record.add_kmpl_lph')
            </a>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('kmpl_lph_record.kmpl_lph_record')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('kmpl_lph_record.kmpl_lph_record')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('kmpl_lph_record.kmpl_lph_record')])
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
            $error_class = $errors->has('examinor_signature') ? 'parsley-error ' : ''; @endphp
        <label for="examinor_signature" class="form-label">@lang('kmpl_lph_record.examinor_signature')</label>
        <div class="form-group">
            {{ Form::file('examinor_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'examinor_signature', 'onchange' => "preview_examinor_signature(this)",  'accept' => "examinor_signature/*"]) }}
            @if ($errors->has('examinor_signature'))
                <p class="text-danger">{{$errors->first('examinor_signature')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        <label class="col-form-label" for="examinor_signature">@lang('kmpl_lph_record.examinor_signature_preview')</label><br>
        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="examinor_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">
    </div>

    @if(Request::segment(4) == 'edit')
        <div class="col-sm-12 col-md-4 my-2">
            <label class="col-form-label">
                @lang('kmpl_lph_record.examinor_signature_existing')
                {{ Form::checkbox('remove_examinor_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_examinor_signature']) }}
                <label for="remove_examinor_signature" class="form-label">@lang('kmpl_lph_record.remove_examinor_signature')</label>
            </label><br>
            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($kmpl_lph_record->examinor_signature->source ?? '')}}" alt="@lang('kmpl_lph_record.examinor_signature_existing')">
        </div>
    @endif
</div>
<div class="row">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('driver_signature') ? 'parsley-error ' : ''; @endphp
        <label for="driver_signature" class="form-label">@lang('kmpl_lph_record.driver_signature')</label>
        <div class="form-group">
            {{ Form::file('driver_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'driver_signature', 'onchange' => "preview_driver_signature(this)",  'accept' => "driver_signature/*"]) }}
            @if ($errors->has('driver_signature'))
                <p class="text-danger">{{$errors->first('driver_signature')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        <label class="col-form-label" for="driver_signature">@lang('kmpl_lph_record.driver_signature_preview')</label><br>
        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="driver_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">
    </div>

    @if(Request::segment(4) == 'edit')
        <div class="col-sm-12 col-md-4 my-2">
            <label class="col-form-label">
                @lang('kmpl_lph_record.driver_signature_existing')
                {{ Form::checkbox('remove_driver_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_driver_signature']) }}
                <label for="remove_driver_signature" class="form-label">@lang('kmpl_lph_record.remove_driver_signature')</label>
            </label><br>
            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($kmpl_lph_record->driver_signature->source ?? '')}}" alt="@lang('kmpl_lph_record.driver_signature_existing')">
        </div>
    @endif
</div>--}}
{{--<div class="row">--}}
{{--    <div class="col-sm-12 col-md-4 my-2">--}}
{{--        @php /** @var string $errors */--}}
{{--            $error_class = $errors->has('sso_so_signature') ? 'parsley-error ' : ''; @endphp--}}
{{--        <label for="sso_so_signature" class="form-label">@lang('kmpl_lph_record.sso_so_signature')</label>--}}
{{--        <div class="form-group">--}}
{{--            {{ Form::file('sso_so_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'sso_so_signature', 'onchange' => "preview_sso_so_signature(this)",  'accept' => "sso_so_signature/*"]) }}--}}
{{--            @if ($errors->has('sso_so_signature'))--}}
{{--                <p class="text-danger">{{$errors->first('sso_so_signature')}}</p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="col-sm-12 col-md-4 my-2">--}}
{{--        <label class="col-form-label" for="sso_so_signature">@lang('kmpl_lph_record.sso_so_signature_preview')</label><br>--}}
{{--        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="sso_so_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">--}}
{{--    </div>--}}

{{--    @if(Request::segment(4) == 'edit')--}}
{{--        <div class="col-sm-12 col-md-4 my-2">--}}
{{--            <label class="col-form-label">--}}
{{--                @lang('kmpl_lph_record.sso_so_signature_existing')--}}
{{--                {{ Form::checkbox('remove_sso_so_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_sso_so_signature']) }}--}}
{{--                <label for="remove_sso_so_signature" class="form-label">@lang('kmpl_lph_record.remove_sso_so_signature')</label>--}}
{{--            </label><br>--}}
{{--            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($kmpl_lph_record->sso_so_signature->source ?? '')}}" alt="@lang('kmpl_lph_record.sso_so_signature_existing')">--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</div>--}}

<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('kmpl_lph_record.kmpl_lph_record')])
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
            reader.readAsDataURL(file);
        }
    }*/

    $(function () {
        let vue = new Vue({
            el: '#vue',
            data: {
                employees:{!! @$employees !!},
                designations:{!! @$designations !!},
                kmpl_lph_inputs: [{
                    examiner_employee_id:'',
                    examiner_designation_id:'',
                    result_kmpl:'',
                    result_lph:'',
                    exam_date:'',
                }],
            },
            methods: {
                addMoreKmpl(){
                    this.kmpl_lph_inputs.push({
                        examiner_employee_id:'',
                        examiner_designation_id:'',
                        result_kmpl:'',
                        result_lph:'',
                        exam_date:'',
                    });
                },
                removeKmpl(index) {
                    this.kmpl_lph_inputs.splice(index, 1);
                },
                load_parameters(){
                    {{--console.log({!! @$kmpl_lph_record->kmplLphDetails !!})--}}
                    this.kmpl_lph_inputs = {!! @$kmpl_lph_record->kmplLphDetails ?? '{}' !!}
                },
            },
            created() {
                @if(\Route::currentRouteName() == 'kmpl_lph_record.edit')
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
                    // console.log(response)
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
                    // console.log(response)
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
    $(document).on('submit', '.kmpl_lph_record_submit', function (event) {
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

                        if (error[0].includes('kmpl_lph_details.')){
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
