<style>
    .form-label {
        margin-bottom: -0.5rem;
        /* font-size: 10px;
        font-weight: bold; */
    }
</style>
<div class="row mb-3">
    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('workshop_order_id') ? 'parsley-error ' : ''; @endphp
        <label for="workshop_order_id" class="form-label">@lang('inspection_report.workshop_order_number')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('workshop_order_id', $workshop_orders, null, ['class' =>
            $error_class.'form-control select2 workshop_order_id', 'v-on:change'=>'faultSelect', 'placeholder' =>
            trans('common.select'), 'id'
            => 'workshop_order_id', 'required' => true]) }}
            @if ($errors->has('workshop_order_id'))
                <p class="text-danger">{{$errors->first('workshop_order_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
        <label for="type_id" class="form-label">@lang('workshop_order.type')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->workSopOrder->product->type_id, ['class' => $error_class
            .'form-control',
            'id' => 'type_id', 'readonly', ]) }}
            @if ($errors->has('type_id'))
                <p class="text-danger">{{$errors->first('type_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
        <label for="" class="form-label">@lang('workshop_order.category')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->workSopOrder->product->category_id, ['class' => $error_class
           .'form-control',
           'id' => 'category_id', 'readonly', ]) }}

            @if ($errors->has('category_id'))
                <p class="text-danger">{{$errors->first('category_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('brand_id') ? 'parsley-error ' : ''; @endphp
        <label for="brand_id" class="form-label">@lang('workshop_order.brand')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->workSopOrder->product->brand_id, ['class' =>
            $error_class.'form-control', 'id' => 'brand_id', 'readonly', ]) }}
            @if ($errors->has('brand_id'))
                <p class="text-danger">{{$errors->first('brand_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('model_id') ? 'parsley-error ' : ''; @endphp
        <label for="model_id" class="form-label">@lang('workshop_order.model')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->workSopOrder->product->model_id, ['class' =>
            $error_class.'form-control', 'id' => 'model_id', 'readonly',]) }}
            @if ($errors->has('model_id'))
                <p class="text-danger">{{$errors->first('model_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('product_id') ? 'parsley-error ' : ''; @endphp
        <label for="product_id" class="form-label">@lang('workshop_order.product')</label>
        <div class="form-group text-uppercase">
            {{ Form::text('', @$inspection_report->workSopOrder->product->product_id, ['class' => $error_class.'form-control',
             'id' => 'product_id', 'readonly']) }}
            @if ($errors->has('product_id'))
                <p class="text-danger">{{$errors->first('product_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('registration_number') ? 'parsley-error ' : ''; @endphp
        <label for="registration_number" class="form-label">@lang('inspection_report.registration_divisional_number')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->product->registration_number, ['class' =>
            $error_class.'form-control', 'id' => 'registration_number', 'readonly']) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('workshop_id') ? 'parsley-error ' : ''; @endphp
        <label for="workshop_id" class="form-label">@lang('inspection_report.workshop')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->workshop->workshop_id, ['class' => $error_class
            .'form-control', 'id' =>
            'workshop_id', 'readonly', ]) }}
            @if ($errors->has('workshop_id'))
                <p class="text-danger">{{$errors->first('workshop_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('fire_station_id') ? 'parsley-error ' : ''; @endphp
        <label for="fire_station_id" class="form-label">@lang('fire_station.fire_station')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->product->fire_station->bn_name, ['class'
             => $error_class.'form-control', 'id' =>
             'fire_station_id', 'readonly']) }}
            @if ($errors->has('fire_station_id'))
                <p class="text-danger">{{$errors->first('fire_station_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('mileage') ? 'parsley-error ' : ''; @endphp
        <label for="mileage" class="form-label">@lang('workshop_order.mileage')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->mileage, ['class' => $error_class
            .'form-control', 'id' => 'mileage', 'readonly', ]) }}
            @if ($errors->has('mileage'))
                <p class="text-danger">{{$errors->first('mileage')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('order_date') ? 'parsley-error ' : ''; @endphp
        <label for="order_date" class="form-label">@lang('inspection_report.order_date')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->order_date ? date('d-m-Y',strtotime
            ($inspection_report->order_date)) : null, ['class' => $error_class.'form-control',
            'id' => 'order_date', 'readonly', ]) }}
            @if ($errors->has('order_date'))
                <p class="text-danger">{{$errors->first('order_date')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('fuel_type') ? 'parsley-error ' : ''; @endphp
        <label for="fuel_type" class="form-label">@lang('workshop_order.fuel_type')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->fuel_type,['class' => $error_class.'form-control', 'id' => 'fuel_type','readonly',
             ]) }}
            @if ($errors->has('fuel_type'))
                <p class="text-danger">{{$errors->first('fuel_type')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('fuel') ? 'parsley-error ' : ''; @endphp
        <label for="fuel" class="form-label">@lang('workshop_order.fuel')</label>
        <div class="form-group">
            {{ Form::text('', @$inspection_report->fuel, ['class' => $error_class
            .'form-control', 'id' => 'fuel', 'readonly', ]) }}
            @if ($errors->has('fuel'))
                <p class="text-danger">{{$errors->first('fuel')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('serial_number') ? 'parsley-error ' : ''; @endphp
        <label for="serial_number" class="form-label">@lang('inspection_report.serial_number')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::number('serial_number', null, ['class' => $error_class
            .'form-control', 'id' => 'serial_number','required' => 1]) }}
            @if ($errors->has('serial_number'))
                <p class="text-danger">{{$errors->first('serial_number')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('inspection_date') ? 'parsley-error ' : ''; @endphp
        <label for="inspection_date" class="form-label">@lang('inspection_report.inspection_date')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('inspection_date', @$inspection_report->inspection_date ? date('d-m-Y',strtotime
            ($inspection_report->inspection_date)) : null, ['class' => $error_class.'form-control datepicker', 'id'=>'inspection_date', 'autocomplete' => 'off', 'required' => 1]) }}
            @if ($errors->has('inspection_date'))
                <p class="text-danger">{{$errors->first('inspection_date')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status')</label>
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

    {{-- Add row code start --}}
    <div id="vue" class="mt-5">
        <hr>
        <h6 class="font-weight-semibold">@lang('inspection_report.demands')</h6>
        <div v-for="(row,index) in inspection_demand_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">
                <div class="col-sm-12">
                    <h5>
                        <span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{ index+1 }}</span>
                    </h5>
                </div>
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm" @click="removeInspectionDemand
                    (index)"><i class="fas fa-times text-warning"></i></button>
                </div>
                <div class="row" >
                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('fault') ? 'parsley-error ' : ''; @endphp
                        <label for="fault" class="form-label">@lang('workshop_order.fault')</label>
                        <div class="form-group">
                            <input v-model="@if($inspection_report == null) row.name @else row.fault @endif" class="{{$error_class}} form-control" :name="'demand_details['+index+'][fault]'">
                            @if ($errors->has('fault'))
                                <p class="text-danger">{{$errors->first('fault')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('fault_type_id') ? 'parsley-error ' : ''; @endphp
                        <label for="fault_type_id" class="form-label">@lang('product.type')</label>
                        <div class="form-group">
                            <select v-model="row.fault_type_id" class="$error_class form-control" :name="'demand_details['+index+'][fault_type_id]'" onchange=SelectChange("{{ route('get_categories_by_type') }}","category_id",this)>
                                <option value="">@lang('common.select_one')</option>
                                @foreach($types as $key=>$type)
                                    <option value="{{$key}}">{{$type}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('fault_type_id'))
                                <p class="text-danger">{{$errors->first('fault_type_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('fault_category_id') ? 'parsley-error ' : ''; @endphp
                        <label for="fault_category_id" class="form-label">@lang('category.category')</label>
                        <div class="form-group">
                            <select v-model="row.fault_category_id" :name="'demand_details['+index+'][fault_category_id]'" class="{{$error_class}} form-control select2vue category_id">
                                <option value="">@lang('common.select_one')</option>
                                @foreach($category_lists as $key=>$category)
                                    <option value="{{$key}}">{{$category}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('fault_category_id'))
                                <p class="text-danger">{{$errors->first('fault_category_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('fault_brand_id') ? 'parsley-error ' : ''; @endphp
                        <label for="fault_brand_id" class="form-label">@lang('product.brand')</label>
                        <div class="form-group input-group">
                            <select v-model="row.fault_brand_id" :name="'demand_details['+index+'][fault_brand_id]'" class="{{$error_class}} form-control select2vue brand_id" onchange = SelectChange("{{route('get_models')}}","model_id",this) >
                                <option value="">@lang('common.select_one')</option>
                                @foreach($brands as $key=>$brand)
                                    <option value="{{$key}}">{{$brand}}</option>
                                @endforeach
                            </select>
                            <a href="{{route('brand_create_modal')}}" class="input-group-text modal_lg_button text-secondary">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                            @if ($errors->has('fault_brand_id'))
                                <p class="text-danger">{{$errors->first('fault_brand_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('fault_model_id') ? 'parsley-error ' : ''; @endphp
                        <label for="fault_model_id" class="form-label">@lang('product.model')</label>
                        <div class="form-group input-group">
                            <select v-model="row.fault_model_id" :name="'demand_details['+index+'][fault_model_id]'" class="{{$error_class}} form-control model_id" onchange = SelectChange("{{route('get_product_part_by_model')}}","product_part_id",this)>
                                <option value="">@lang('common.select_one')</option>
                                @foreach($model_lists as $key=>$model)
                                    <option value="{{$key}}">{{$model}}</option>
                                @endforeach
                                <a href="{{route('model_create_modal')}}" class="input-group-text modal_lg_button text-secondary" parent="brand_id">
                                    <i class="fa fa-plus-circle"></i>
                                </a>
                            </select>
                            @if ($errors->has('fault_model_id'))
                                <p class="text-danger">{{$errors->first('fault_model_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('product_part_id') ? 'parsley-error ' : ''; @endphp
                        <label for="product_part_id" class="form-label">@lang('workshop_order.product_name')</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group input-group">
                            <select v-model="row.product_part_id" :name="'demand_details['+index+'][product_part_id]'" class="{{$error_class}} form-control product_part_id" required="1">
                            <option value="">@lang('common.select_one')</option>
                            @foreach($product_parts as $key=>$product_part)
                                <option value="{{$key}}">{{$product_part}}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('product_part_id'))
                                <p class="text-danger">{{$errors->first('product_part_id')}}</p>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('repair_work') ? 'parsley-error ' : ''; @endphp
                        <label for="repair_work" class="form-label">@lang('workshop_order.repair_work')</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <input v-model="row.repair_work" :name="'demand_details['+index+'][repair_work]'"  class="{{$error_class}} form-control" required="1">
                            @if ($errors->has('repair_work'))
                                <p class="text-danger">{{$errors->first('repair_work')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('amount') ? 'parsley-error ' : ''; @endphp
                        <label for="amount" class="form-label">@lang('common.amount')</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <input v-model="row.amount" :name="'demand_details['+index+'][amount]'" class="{{$error_class}} form-control" required="1">
                            @if ($errors->has('amount'))
                                <p class="text-danger">{{$errors->first('amount')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php $error_class = $errors->has('remarks') ? 'parsley-error ' : ''; @endphp
                        <label for="remarks" class="form-label">@lang('common.remarks')</label>
                        <div class="form-group">
                            <input v-model="row.remarks"  :name="'demand_details['+index+'][remarks]'" class="{{$error_class}} form-control">
                            @if ($errors->has('remarks'))
                                <p class="text-danger">{{$errors->first('remarks')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-right">
            <a href="javascript:" class="btn btn-success" @click="addMoreInspectionDemand">
                <i class="fa fa-plus-circle"></i>
                @lang('inspection_report.add_demand')
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit')
        </button>
    </div>
</div>

@include('components.modal_lg')

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
                    type_id : '{!! @$product->type_id ? $product->type_id : '' !!}',
                    category_id : '{!! @$product->category_id ? $product->category_id : '' !!}',
                    brand_id : '{!! @$product->brand_id ? $product->brand_id : '' !!}',
                    model_id : '{!! @$product->model_id ? $product->model_id : '' !!}',
                    categories: {!! @$categories ? $categories: '{}' !!},
                    brands: {!! $brands !!},
                    models: {!! @$models ? $models: '{}' !!},
                    type: '',
                    product_part: '',
                    inspection_demand_inputs: [{
                        name:'',
                        fault_type_id:'',
                        fault_category_id:'',
                        fault_brand_id:'',
                        fault_model_id:'',
                        product_part_id:'',
                        repair_work:'',
                        amount:'',
                        remarks: '',
                    }],
                },

                methods: {
                    getResponseDataFromAjax(response){
                        if(response.categories){
                            this.categories = []
                            this.categories = response.categories
                            this.category_id = response.category.id
                            this.type_id = response.category.type_id
                        }
                        if(response.brands){
                            this.brands = []
                            this.brands = response.brands
                            this.brand_id = response.brand.id
                        }
                        if(response.models){
                            this.models = []
                            this.models = response.models
                            this.model_id = response.model.id
                            this.brand_id = response.model.brand_id
                            $('.brand_id').val(response.model.brand_id)
                        }
                    },

                    addMoreInspectionDemand(){
                        this.inspection_demand_inputs.push({
                            name:'',
                            fault_type_id:'',
                            fault_category_id:'',
                            fault_brand_id:'',
                            fault_model_id:'',
                            product_part_id:'',
                            repair_work:'',
                            amount:'',
                            remarks: '',
                        });
                    },

                    removeInspectionDemand(index) {
                        this.inspection_demand_inputs.splice(index, 1);
                    },

                    faultSelect(){
                        //axios call
                        this.inspection_demand_inputs = {!! @$inspection_report->demands ?? '{}' !!}
                    },

                    load_parameters(){
                        $('#type_id').val('{!! @$inspection_report->workshopOrder->product->type->bn_name !!}')
                        $('#category_id').val('{!! @$inspection_report->workshopOrder->product->category->bn_name !!}')
                        $('#brand_id').val('{!! @$inspection_report->workshopOrder->product->brand->bn_name !!}')
                        $('#model_id').val('{!! @$inspection_report->workshopOrder->product->model->bn_name !!}')
                        $('#product_id').val('{!! @$inspection_report->workshopOrder->product->tracking_no !!}')
                        $('#registration_number').val('{!! @$inspection_report->workshopOrder->product->registration_number !!}')
                        $('#workshop_id').val('{!! @$inspection_report->workshopOrder->workshop->bn_name !!}')
                        $('#fire_station_id').val('{!! @$inspection_report->workshopOrder->product->fire_station->bn_name !!}')
                        $('#mileage').val('{!! @$inspection_report->workshopOrder->mileage !!}')
                        $('#order_date').val('{!! @$inspection_report->workshopOrder->order_date !!}')
                        $('#fuel_type').val('{!! @$inspection_report->workshopOrder->fuel_type !!}')
                        $('#fuel').val('{!! @$inspection_report->workshopOrder->fuel !!}')
                        this.inspection_demand_inputs = {!! @$inspection_report->demands ?? '{}' !!}
                        // console.log(this.inspection_demand_inputs);
{{--                        <?php--}}
{{--                            if ($inspection_report) {--}}
{{--                                foreach ($inspection_report->demands as $demand) {--}}
{{--                                    $product_part = $demand->where('inspection_report_id',$inspection_report->id)->with('productPart')->get();--}}
{{--                                }--}}
{{--                            }--}}
{{--                        ?>--}}
{{--                        this.product_part = {!! @$product_part !!}--}}
{{--                        $.each(this.product_part, function( index, value ) {--}}
{{--                            this.fault_category_id = value.product_part.category_id;--}}
{{--                            console.log(this.fault_category_id);--}}
{{--                        });--}}
                    },
                },

                created() {

                },

                mounted() {
                    $(document).trigger('vue-loaded');
                    @if(\Route::currentRouteName() == 'inspection_report.edit')
                        this.load_parameters()
                    @endif
                },

                updated() {
                    $(document).trigger('vue-loaded');
                    make_bangla()
                },
            });

            $('#workshop_order_id').on('change', function () {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                let id = $('#workshop_order_id').val();
                $.ajax({
                    url: '{{route('workshop_order_product')}}',
                    type: 'post',
                    dataType: 'JSON',
                    data : {id: id},
                    cache: false,
                    success: function (response) {
                        console.log(response)
                        $('#type_id').val(response.product.type.bn_name)
                        $('#category_id').val(response.product.category.bn_name)
                        $('#brand_id').val(response.product.brand.bn_name)
                        $('#model_id').val(response.product.model.bn_name)
                        $('#product_id').val(response.product.tracking_no)
                        $('#registration_number').val(response.product.registration_number)
                        $('#workshop_id').val(response.workshop.bn_name)
                        $('#fire_station_id').val(response.product.fire_station.bn_name)
                        $('#mileage').val(response.mileage)
                        $('#order_date').val(response.order_date)
                        $('#fuel_type').val(response.fuel_type)
                        $('#fuel').val(response.fuel)
                        vue.inspection_demand_inputs = response.faults
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
