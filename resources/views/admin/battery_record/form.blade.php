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


    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                        $error_class = $errors->has('battery_size_length') ? 'parsley-error ' : ''; @endphp
        <label for="battery_size_length" class="form-label">@lang('battery_record.battery_size_length',['model' => trans('battery_record.battery_record')])</label>
        <div class="form-group">
            {{ Form::text('battery_size_length', null, ['class' => $error_class.'form-control', 'placeholder' => trans('battery_record.battery_size_length'), 'id' => 'battery_size_length', 'required' => 1]) }}
            @if ($errors->has('battery_size_length'))
                <p class="text-danger">{{$errors->first('battery_size_length')}}</p>
            @endif
        </div>
    </div>


    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                        $error_class = $errors->has('battery_size_width') ? 'parsley-error ' : ''; @endphp
        <label for="battery_size_width" class="form-label">@lang('battery_record.battery_size_width',['model' => trans('battery_record.battery_record')])</label>
        <div class="form-group">
            {{ Form::text('battery_size_width', null, ['class' => $error_class.'form-control', 'placeholder' => trans('battery_record.battery_size_width'), 'id' => 'battery_size_width', 'required' => 1]) }}
            @if ($errors->has('battery_size_width'))
                <p class="text-danger">{{$errors->first('battery_size_width')}}</p>
            @endif
        </div>
    </div>



    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                        $error_class = $errors->has('battery_size_height') ? 'parsley-error ' : ''; @endphp
        <label for="battery_size_height" class="form-label">@lang('battery_record.battery_size_height',['model' => trans('battery_record.battery_record')])</label>
        <div class="form-group">
            {{ Form::text('battery_size_height', null, ['class' => $error_class.'form-control', 'placeholder' => trans('battery_record.battery_size_height'), 'id' => 'battery_size_height', 'required' => 1]) }}
            @if ($errors->has('battery_size_height'))
                <p class="text-danger">{{$errors->first('battery_size_height')}}</p>
            @endif
        </div>
    </div>


    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                        $error_class = $errors->has('battery_numbers') ? 'parsley-error ' : ''; @endphp
        <label for="battery_numbers" class="form-label">@lang('battery_record.battery_numbers',['model' => trans('battery_record.battery_record')])</label>
        <div class="form-group">
            {{ Form::text('battery_numbers', null, ['class' => $error_class.'form-control', 'placeholder' => trans('battery_record.battery_numbers'), 'id' => 'battery_numbers', 'required' => 1]) }}
            @if ($errors->has('battery_numbers'))
                <p class="text-danger">{{$errors->first('battery_numbers')}}</p>
            @endif
        </div>
    </div>


    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                        $error_class = $errors->has('battery_plate') ? 'parsley-error ' : ''; @endphp
        <label for="battery_plate" class="form-label">@lang('battery_record.battery_plate',['model' => trans('battery_record.battery_record')])</label>
        <div class="form-group">
            {{ Form::text('battery_plate', null, ['class' => $error_class.'form-control', 'placeholder' => trans('battery_record.battery_plate'), 'id' => 'battery_plate', 'required' => 1]) }}
            @if ($errors->has('battery_plate'))
                <p class="text-danger">{{$errors->first('battery_plate')}}</p>
            @endif
        </div>
    </div>


    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
                        $error_class = $errors->has('battery_ampere') ? 'parsley-error ' : ''; @endphp
        <label for="battery_ampere" class="form-label">@lang('battery_record.battery_ampere',['model' => trans('battery_record.battery_record')])</label>
        <div class="form-group">
            {{ Form::text('battery_ampere', null, ['class' => $error_class.'form-control', 'placeholder' => trans('battery_record.battery_ampere'), 'id' => 'battery_ampere', 'required' => 1]) }}
            @if ($errors->has('battery_ampere'))
                <p class="text-danger">{{$errors->first('battery_ampere')}}</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <hr>
        <h6 class="font-weight-semibold">@lang('battery_record.battery_records')</h6>
        <div v-for="(row,index) in battery_record_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">
                <div class="col-sm-12">
                    <h5><span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{index+1}}</span></h5>
                </div>
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm" @click="removebatteryDetails(index)"><i
                            class="fas fa-times text-warning"></i> </button>
                </div>
                <div class="row" >

                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('issue_date') ? 'parsley-error ' : ''; @endphp
                        <label for="issue_date" class="form-label">@lang('battery_record.issue_date')</label>
                        <div class="form-group">
                            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy" v-model="row.issue_date" class="{{$error_class}} form-control" :name="'battery_records['+index+'][issue_date]'" id="issue_date">
                            @if ($errors->has('issue_date'))
                                <p class="text-danger">{{$errors->first('issue_date')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('battery_brand') ? 'parsley-error ' : ''; @endphp
                        <label for="battery_brand" class="form-label">@lang('battery_record.battery_brand',['model' => trans('battery_record.battery_record')])</label>
                        <div class="form-group">
                            <input v-model="row.battery_brand" class="{{$error_class}} form-control"
                                   :name="'battery_records['+index+'][battery_brand]'" id="battery_brand">
                            @if ($errors->has('battery_brand'))
                                <p class="text-danger">{{$errors->first('battery_brand')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('battery_number') ? 'parsley-error ' : ''; @endphp
                        <label for="battery_number" class="form-label">@lang('battery_record.battery_number',['model' => trans('battery_record.battery_record')])</label>
                        <div class="form-group">
                            <input v-model="row.battery_number" class="{{$error_class}} form-control"
                                   :name="'battery_records['+index+'][battery_number]'" id="battery_number">
                            @if ($errors->has('battery_number'))
                                <p class="text-danger">{{$errors->first('battery_number')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('full_charge_gravity') ? 'parsley-error ' : ''; @endphp
                        <label for="full_charge_gravity" class="form-label">@lang('battery_record.full_charge_gravity',['model' => trans('battery_record.battery_record')])</label>
                        <div class="form-group">
                            <input v-model="row.full_charge_gravity" class="{{$error_class}} form-control"
                                   :name="'battery_records['+index+'][full_charge_gravity]'" id="full_charge_gravity">
                            @if ($errors->has('full_charge_gravity'))
                                <p class="text-danger">{{$errors->first('full_charge_gravity')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('rejected_announced_date') ? 'parsley-error ' : ''; @endphp
                        <label for="rejected_announced_date" class="form-label">@lang('battery_record.rejected_announced_date')</label>
                        <div class="form-group">
                            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy" v-model="row.rejected_announced_date" class="{{$error_class}} form-control" :name="'battery_records['+index+'][rejected_announced_date]'" id="rejected_announced_date">
                            @if ($errors->has('rejected_announced_date'))
                                <p class="text-danger">{{$errors->first('rejected_announced_date')}}</p>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('duty_driver_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="duty_driver_employee_id" class="form-label">@lang('common.model',['model' => trans('battery_record.duty_driver_employee_id')])</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue duty_driver_employee_id" :name="'battery_records['+index+'][duty_driver_employee_id]'">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(employee,index) in visitor_employees" :value="index"    :selected="index == row.duty_driver_employee_id">@{{employee}}
                                </option>
                            </select>
                            @if ($errors->has('duty_driver_employee_id'))
                                <p class="text-danger">{{$errors->first('duty_driver_employee_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('sso_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="sso_employee_id" class="form-label">@lang('common.model',['model' => trans('battery_record.sso_employee_id')])</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue sso_employee_id" :name="'battery_records['+index+'][sso_employee_id]'">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(employee,index) in visitor_employees" :value="index"    :selected="index == row.sso_employee_id">@{{employee}}
                                </option>
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
            <a href="javascript:" class="btn btn-success"  @click="addMorebatteryDetails">
                <i class="fa fa-plus-circle"></i>
                @lang('battery_record.add_battery_record')
            </a>
        </div>
    </div>



    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('battery_record.battery_record')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('battery_record.battery_record')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('battery_record.battery_record')])
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
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('battery_record.battery_record')])
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
                battery_record_inputs: [{
                    // duty_driver_employee_id:'',
                    // sso_employee_id:'',
                    issue_date:'',
                    battery_brand:'',
                    battery_number:'',
                    full_charge_gravity:'',
                    rejected_announced_date:'',
                }],
            },
            methods: {
                addMorebatteryDetails(){
                    this.battery_record_inputs.push({
                        // visitor_employee_id:'',
                        // visitor_helper_employee_id:'',
                        issue_date:'',
                        battery_brand:'',
                        battery_number:'',
                        full_charge_gravity:'',
                        rejected_announced_date:'',
                    });
                },
                removebatteryDetails(index) {
                    this.battery_record_inputs.splice(index, 1);
                },
                load_parameters(){
                    console.log({!! @$battery_record->batteryDetails !!})
                    this.battery_record_inputs = {!! @$battery_record->batteryDetails ?? '{}' !!}
                },
            },
            created() {
                @if(\Route::currentRouteName() == 'battery_record.edit')
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
</script>

@include('admin.layouts.partial.footer.vue_loaded_script')

@if(!request()->ajax()) @endsection @endif
