<div class="row mb-3">

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


    <div id="vue" class="mt-3">
        <hr>
        <h6 class="font-weight-semibold">@lang('vehicle_maintenance_order.vehicle_maintenance_orders')</h6>
        <div v-for="(row,index) in vehicle_maintenance_order_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">
                <div class="col-sm-12">
                    <h5><span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{index+1}}</span></h5>
                </div>
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm" @click="removeVehicleMaintenanceDetails(index)"><i
                            class="fas fa-times text-warning"></i> </button>
                </div>
                <div class="row" >

                    <div class="col-sm-12 col-md-4">
                        @php /** @var string $errors */
                            $error_class = $errors->has('serial_number') ? 'parsley-error ' : ''; @endphp
                        <label for="serial_number" class="form-label">@lang('vehicle_maintenance_order.serial_number',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])</label>
                        <div class="form-group">
                            <input v-model="row.serial_number" class="{{$error_class}} form-control"
                                   :name="'vehicle_maintenance_orders['+index+'][serial_number]'">
                            @if ($errors->has('serial_number'))
                                <p class="text-danger">{{$errors->first('serial_number')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php /** @var string $errors */
                            $error_class = $errors->has('subject') ? 'parsley-error ' : ''; @endphp
                        <label for="subject" class="form-label">@lang('vehicle_maintenance_order.subject',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])</label>
                        <div class="form-group">
                            <input v-model="row.subject" class="{{$error_class}} form-control"
                                   :name="'vehicle_maintenance_orders['+index+'][subject]'">
                            @if ($errors->has('subject'))
                                <p class="text-danger">{{$errors->first('subject')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('order_giving_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="order_giving_employee_id" class="form-label">@lang('common.model',['model' => trans('vehicle_maintenance_order.order_giving_employee_id')])</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <select class="{{$error_class}} form-control select2vue order_giving_employee_id" :name="'vehicle_maintenance_orders['+index+'][order_giving_employee_id]'">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(employee,index) in employees" :value="index"    :selected="index == row.order_giving_employee_id">@{{employee}}
                                </option>
                            </select>
                            @if ($errors->has('order_giving_employee_id'))
                                <p class="text-danger">{{$errors->first('order_giving_employee_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php /** @var string $errors */
                            $error_class = $errors->has('memorandum_number') ? 'parsley-error ' : ''; @endphp
                        <label for="memorandum_number" class="form-label">@lang('vehicle_maintenance_order.memorandum_number',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])</label>
                        <div class="form-group">
                            <input v-model="row.memorandum_number" class="{{$error_class}} form-control"
                                   :name="'vehicle_maintenance_orders['+index+'][memorandum_number]'" id="memorandum_number">
                            @if ($errors->has('memorandum_number'))
                                <p class="text-danger">{{$errors->first('memorandum_number')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('memorandum_date') ? 'parsley-error ' : ''; @endphp
                        <label for="memorandum_date" class="form-label">@lang('vehicle_maintenance_order.memorandum_date')</label>
                        <div class="form-group">
                            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy" v-model="row.memorandum_date" class="{{$error_class}} form-control"
                                   :name="'vehicle_maintenance_orders['+index+'][memorandum_date]'" id="memorandum_date">
                            @if ($errors->has('memorandum_date'))
                                <p class="text-danger">{{$errors->first('memorandum_date')}}</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-sm-12 text-right">
            <a href="javascript:" class="btn btn-success"  @click="addMoreVehicleMaintenanceDetails">
                <i class="fa fa-plus-circle"></i>
                @lang('vehicle_maintenance_order.add_vehicle_maintenance_order')
            </a>
        </div>
    </div>



    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])
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
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('vehicle_maintenance_order.vehicle_maintenance_order')])
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
                vehicle_maintenance_order_inputs: [{
                    serial_number:'',
                    subject:'',
                    memorandum_number:'',
                    memorandum_date:'',
                }],
            },
            methods: {
                addMoreVehicleMaintenanceDetails(){
                    this.vehicle_maintenance_order_inputs.push({
                        serial_number:'',
                        subject:'',
                        memorandum_number:'',
                        memorandum_date:'',
                    });
                },
                removeVehicleMaintenanceDetails(index) {
                    this.vehicle_maintenance_order_inputs.splice(index, 1);
                },
                load_parameters(){
                    {{--console.log({!! @$vehicle_maintenance_order->vehicleMaintenanceDetails !!})--}}
                    this.vehicle_maintenance_order_inputs = {!! @$vehicle_maintenance_order->vehicleMaintenanceDetails ?? '{}' !!}
                },
            },
            created() {
                @if(\Route::currentRouteName() == 'vehicle_maintenance_order.edit')
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
</script>

@include('admin.layouts.partial.footer.vue_loaded_script')

@if(!request()->ajax()) @endsection @endif
