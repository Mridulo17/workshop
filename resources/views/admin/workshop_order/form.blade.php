<div class="row mb-3">

    @if(@$workshop_order->tracking_no)
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('tracking_no') ? 'parsley-error ' : ''; @endphp
        <label for="tracking_no" class="form-label">@lang('workshop_order.tracking_no')</label>
        <div class="form-group">
            {{ Form::text('tracking_no', $workshop_order->tracking_no, ['class' => $error_class.'form-control', 'id' => 'tracking_no', 'required' => false, 'disabled']) }}
            @if ($errors->has('tracking_no'))
                <p class="text-danger">{{$errors->first('tracking_no')}}</p>
            @endif
        </div>
    </div>
    @endif

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
        $error_class = $errors->has('order_date') ? 'parsley-error ' : ''; @endphp
        <label for="order_date" class="form-label">@lang('workshop_order.order_date')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('order_date', @$workshop_order->order_date ? date('d-m-Y',strtotime($workshop_order->order_date)) : null, ['class' => $error_class.'form-control datepicker', 'autocomplete' => 'off', 'required' => 1]) }}
            @if ($errors->has('order_date'))
                <p class="text-danger">{{$errors->first('order_date')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('workshop_id') ? 'parsley-error ' : ''; @endphp
        <label for="workshop_id" class="form-label">@lang('workshop_order.workshop')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('workshop_id', $workshops, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'workshop_id', 'required' => false]) }}
            @if ($errors->has('workshop_id'))
                <p class="text-danger">{{$errors->first('workshop_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
        <label for="type_id" class="form-label">@lang('workshop_order.type')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('type_id', $types, null, ['class' => $error_class.'form-control select2 type_id', 'placeholder' => trans('common.select'), 'id' => 'type_id', 'required' => false, 'onchange' => 'SelectChange("'.route('get_categories_by_type').'","category_id",this)']) }}
            @if ($errors->has('type_id'))
                <p class="text-danger">{{$errors->first('type_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
        <label for="category_id" class="form-label">@lang('workshop_order.category')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('category_id', $categories, null, ['class' => $error_class.'form-control select2 category_id', 'placeholder' => trans('common.select'), 'id' => 'category_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","product_id",this,"model_id")']) }}

{{--            {{ Form::select('category_id', $categories, null, ['class' => $error_class.'form-control select2 category_id', 'placeholder' => trans('common.select'), 'id' => 'category_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","product_id",this,"model_id")']) }}--}}
            @if ($errors->has('category_id'))
                <p class="text-danger">{{$errors->first('category_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('brand_id') ? 'parsley-error ' : ''; @endphp
        <label for="brand_id" class="form-label">@lang('workshop_order.brand')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('brand_id', $brands, null, ['class' => $error_class.'form-control select2 brand_id', 'placeholder' => trans('common.select'), 'id' => 'brand_id', 'required' => false, 'onchange' => 'SelectChange("'.route('get_models').'","model_id",this)']) }}
            @if ($errors->has('brand_id'))
                <p class="text-danger">{{$errors->first('brand_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('model_id') ? 'parsley-error ' : ''; @endphp
        <label for="model_id" class="form-label">@lang('workshop_order.model')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('model_id', $models, null, ['class' => $error_class.'form-control select2 model_id', 'placeholder' => trans('common.select'), 'id' => 'model_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","product_id",this,"category_id")']) }}
            @if ($errors->has('model_id'))
                <p class="text-danger">{{$errors->first('model_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('product_id') ? 'parsley-error ' : ''; @endphp
        <label for="product_id" class="form-label">@lang('workshop_order.product')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group text-uppercase">
            {{ Form::select('product_id', $products, null, ['class' => $error_class.'form-control select2 product_id', 'placeholder' => trans('common.select'), 'id' => 'product_id', 'required' => false, 'onchange' => 'SelectChange("'.route('get_drivers').'","driver_id",this)']) }}
            @if ($errors->has('product_id'))
                <p class="text-danger">{{$errors->first('product_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('registration_number') ? 'parsley-error ' : ''; @endphp
        <label for="registration_number" class="form-label">@lang('workshop_order.registration_divisional_number')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('registration_number', $product_registration_numbers, null, ['class' =>
            $error_class.'form-control select2 registration_number', 'placeholder' =>
            trans('common.select'), 'id' => 'registration_number', 'required' =>
            false]) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>


    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('mileage') ? 'parsley-error ' : ''; @endphp
        <label for="mileage" class="form-label">@lang('workshop_order.mileage')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('mileage', null, ['class' => $error_class.'form-control', 'id' => 'mileage', 'required' => 1, 'pattern' => $en_bn_number_pattern]) }}
            @if ($errors->has('mileage'))
                <p class="text-danger">{{$errors->first('mileage')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('fuel_type') ? 'parsley-error ' : ''; @endphp
        <label for="fuel_type" class="form-label">@lang('workshop_order.fuel_type')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('fuel_type', $fuel_types, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'fuel_type', 'required' => false]) }}
            @if ($errors->has('fuel_type'))
                <p class="text-danger">{{$errors->first('fuel_type')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('fuel') ? 'parsley-error ' : ''; @endphp
        <label for="fuel" class="form-label">@lang('workshop_order.fuel')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('fuel', null, ['class' => $error_class.'form-control', 'id' => 'fuel', 'required' => 1, 'pattern' => $en_bn_number_pattern]) }}
            @if ($errors->has('fuel'))
                <p class="text-danger">{{$errors->first('fuel')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('driver_id') ? 'parsley-error ' : ''; @endphp
        <label for="driver_id" class="form-label">@lang('workshop_order.driver')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('driver_id', $drivers, null, ['class' => $error_class.'form-control select2 driver_id', 'placeholder' => trans('common.select'), 'id' => 'driver_id', 'required' => false]) }}
            @if ($errors->has('driver_id'))
                <p class="text-danger">{{$errors->first('driver_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active')
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive')
                </label>
            </div>
            @if ($errors->has('status'))
                <p class="text-danger">{{$errors->first('status')}}</p>
            @endif
        </div>
    </div>

    <hr>
    <div id="vue" class="my-2">
        <div class="row">
            <div class="col-sm-12">
                <h6 class="font-weight-semibold">@lang('workshop_order.faults')</h6>
                <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>@lang('workshop_order.fault')</th>
                            <th width="40%">@lang('common.remarks')</th>
                            <th width="15%">@lang('common.action')</th>
                        </tr>
                    </thead>
                    <tbody class="fault_tbody">
                        <tr class="fault_tr" v-for="(row,index) in fault_inputs">
                            <td lang="bang" class="font-size-18 text-center">
                                @{{index+1}}
                            </td>
                            <td>
                                <input v-model="row.name" class="{{$error_class}} form-control" :name="'fault['+index+'][name]'">
                            </td>
                            <td>
                                <input v-model="row.remarks" class="{{$error_class}} form-control" :name="'fault['+index+'][remarks]'">
                            </td>
                            <td>
                                <button v-if="index != 0" type="button" class="btn btn-danger float-end" @click="removeFault(index)"><i class="fas fa-times text-warning"></i> {{trans('common.delete')}}</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-right">
                <a href="javascript:" class="btn btn-outline-success"  @click="addMoreFault">
                    <i class="fa fa-plus-circle"></i>
                    @lang('workshop_order.add_fault')
                </a>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit')
        </button>
    </div>
</div>

@section('script')
    <script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>

    <script>
        $(function () {
            let vue = new Vue({
                el: '#vue',
                data: {
                    fault_inputs: [{
                        name: '',
                        remarks: '',
                    }],
                },
                methods: {
                    addMoreFault(){
                        this.fault_inputs.push({
                            name: '',
                            remarks: '',
                        });
                    },
                    removeFault(index) {
                        this.fault_inputs.splice(index, 1);
                    },
                    load_parameters(){
                        console.log({!! @$workshop_order->faults !!})
                        this.fault_inputs = {!! @$workshop_order->faults ?? '{}' !!}
                    },
                },
                created() {

                },
                mounted() {
                    $(document).trigger('vue-loaded');
                    @if(\Route::currentRouteName() == 'workshop_order.edit')
                        this.load_parameters()
                    @endif
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
                        $('#workshop_id').val(response.workshop_id)
                        $('#type_id').val(response.type_id)
                        $('#category_id').val(response.category_id)
                        $('#brand_id').val(response.brand_id)
                        $('#model_id').val(response.model_id)

                        $('#registration_number').val(response.id)
                        $('.select2').select2()
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
                        $('#workshop_id').val(response.workshop_id)
                        $('#type_id').val(response.type_id)
                        $('#category_id').val(response.category_id)
                        $('#brand_id').val(response.brand_id)
                        $('#model_id').val(response.model_id)


                        $('#product_id').val(response.id)
                        $('.select2').select2()

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

        });
    </script>
@endsection
