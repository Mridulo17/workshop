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
            {{ Form::select('model_id', $models, null, ['class' => $error_class.'form-control select2vue model_id', 'placeholder' => trans('common.select'), 'id' => 'model_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","employee_id",this,"category_id")']) }}
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
            {{ Form::select('registration_number', $product_registration_numbers, @$product_id, ['class' => $error_class.'form-control select2vue registration_number', 'placeholder' => trans('common.select'), 'id' => 'registration_number', 'required' => false]) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <hr>
        <h6 class="font-weight-semibold">@lang('inspection_testing.inspection_testing')</h6>
        <div v-for="(row,index) in inspection_testing_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">
                <div class="col-sm-12">
                    <h5><span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{index+1}}</span></h5>
                </div>
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm" @click="removeInspectionTestingDetails(index)"><i class="fas fa-times text-warning"></i> </button>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('visitor_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="visitor_employee_id" class="form-label">@lang('common.model',['model' => trans('inspection_testing.visitor_employee_id')])</label>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue visitor_employee_id" :name="'inspection_testing_details['+index+'][visitor_employee_id]'">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(employee,index) in visitor_employees" :value="index"    :selected="index == row.visitor_employee_id">@{{employee}}
                                </option>
                            </select>
                            @if ($errors->has('visitor_employee_id'))
                                <p class="text-danger">{{$errors->first('visitor_employee_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('visitor_designation_id') ? 'parsley-error ' : ''; @endphp
                        <label for="visitor_designation_id" class="form-label">@lang('inspection_testing.visitor_designation_id',['model' => trans('inspection_testing.inspection_testing')])</label>
                        <div class="form-group">
                            <select {{--v-model="row.visitor_designation_id"--}} :name="'inspection_testing_details['+index+'][visitor_designation_id]'" class="{{$error_class}} form-control select2vue">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(designation,index) in visitor_designations" :value="index"    :selected="index == row.visitor_designation_id">@{{designation}}
                                </option>
                            </select>
                            @if ($errors->has('visitor_designation_id'))
                                <p class="text-danger">{{$errors->first('visitor_designation_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('visitor_helper_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="visitor_helper_employee_id" class="form-label">@lang('common.model',['model' => trans('inspection_testing.visitor_helper_employee_id')])</label>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue visitor_helper_employee_id" :name="'inspection_testing_details['+index+'][visitor_helper_employee_id]'">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(employee,index) in visitor_employees" :value="index"    :selected="index == row.visitor_helper_employee_id">@{{employee}}
                                </option>
                            </select>
                            @if ($errors->has('visitor_helper_employee_id'))
                                <p class="text-danger">{{$errors->first('visitor_helper_employee_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('visitor_helper_designation_id') ? 'parsley-error ' : ''; @endphp
                        <label for="visitor_helper_designation_id" class="form-label">@lang('inspection_testing.visitor_helper_designation_id',['model' => trans('inspection_testing.inspection_testing')])</label>
                        <div class="form-group">
                            <select {{--v-model="row.visitor_helper_designation_id"--}} :name="'inspection_testing_details['+index+'][visitor_helper_designation_id]'" class="{{$error_class}} form-control select2vue">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(designation,index) in visitor_designations" :value="index"    :selected="index == row.visitor_helper_designation_id">@{{designation}}
                                </option>
                            </select>
                            @if ($errors->has('inspection_testings'))
                                <p class="text-danger">{{$errors->first('inspection_testings')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('fill_inspection_book') ? 'parsley-error ' : ''; @endphp
                        <label for="fill_inspection_book" class="form-label">@lang('inspection_testing.fill_inspection_book',['model' => trans('inspection_testing.inspection_testing')])</label>
                        <div class="form-group">
                            <input v-model="row.fill_inspection_book" class="{{$error_class}} form-control"
                                   :name="'inspection_testing_details['+index+'][fill_inspection_book]'" id="fill_inspection_book">
                            @if ($errors->has('fill_inspection_book'))
                                <p class="text-danger">{{$errors->first('fill_inspection_book')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('fill_inspection_seat_number') ? 'parsley-error ' : ''; @endphp
                        <label for="fill_inspection_seat_number" class="form-label">@lang('inspection_testing.fill_inspection_seat_number',['model' => trans('inspection_testing.inspection_testing')])</label>
                        <div class="form-group">
                            <input v-model="row.fill_inspection_seat_number" class="{{$error_class}} form-control"
                                   :name="'inspection_testing_details['+index+'][fill_inspection_seat_number]'" id="fill_inspection_seat_number">
                            @if ($errors->has('fill_inspection_seat_number'))
                                <p class="text-danger">{{$errors->first('fill_inspection_seat_number')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('inspection_short_remarks') ? 'parsley-error ' : ''; @endphp
                        <label for="inspection_short_remarks" class="form-label">@lang('inspection_testing.inspection_short_remarks',['model' => trans('inspection_testing.inspection_testing')])</label>
                        <div class="form-group">
                            <input v-model="row.inspection_short_remarks" class="{{$error_class}} form-control"
                                   :name="'inspection_testing_details['+index+'][inspection_short_remarks]'" id="inspection_short_remarks">
                            @if ($errors->has('inspection_short_remarks'))
                                <p class="text-danger">{{$errors->first('inspection_short_remarks')}}</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-sm-12 text-right">
            <a href="javascript:" class="btn btn-success"  @click="addMoreInspectionTestingDetails">
                <i class="fa fa-plus-circle"></i>
                @lang('inspection_testing.add_inspection_testing')
            </a>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('inspection_testing.inspection_testing')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('inspection_testing.inspection_testing')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('inspection_testing.inspection_testing')])
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
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('inspection_testing.inspection_testing')])
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
                visitor_employees:{!! @$employees !!},
                visitor_designations:{!! @$designations !!},
                inspection_testing_inputs: [{
                    // visitor_employee_id:'',
                    // visitor_designation_id:'',
                    // visitor_helper_employee_id:'',
                    // visitor_helper_designation_id:'',
                    fill_inspection_book:'',
                    fill_inspection_seat_number:'',
                    inspection_short_remarks:'',
                }],
            },
            methods: {
                addMoreInspectionTestingDetails(){
                    this.inspection_testing_inputs.push({
                        // visitor_employee_id:'',
                        // visitor_designation_id:'',
                        // visitor_helper_employee_id:'',
                        // visitor_helper_designation_id:'',
                        fill_inspection_book:'',
                        fill_inspection_seat_number:'',
                        inspection_short_remarks:'',
                    });
                },
                removeInspectionTestingDetails(index) {
                    this.inspection_testing_inputs.splice(index, 1);
                },
                load_parameters(){
                    this.inspection_testing_inputs = {!! @$inspection_testing->inspectionTestingDetails ?? '{}' !!}
                },
            },
            created() {
                @if(\Route::currentRouteName() == 'inspection_testing.edit')
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

    $(document).on('submit', '.inspection_testing_submit', function (event) {
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

                        if (error[0].includes('inspection_testing_details.')){
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
