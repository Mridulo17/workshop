<div id="vue" class="row mb-3">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
    $error_class = $errors->has('inspection_report_id') ? 'parsley-error ' : ''; @endphp
        <label for="inspection_report_id" class="form-label">@lang('repair_job_card.inspection_tracking_number')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('inspection_report_id', $inspection_tracking_numbers, null, ['class' =>
            $error_class.'form-control select2vue inspection_report_id', 'v-on:change'=>'faultSelect', 'placeholder' =>
            trans('common.select'), 'id'
            => 'inspection_report_id', 'required' => true]) }}
            @if ($errors->has('inspection_report_id'))
                <p class="text-danger">{{$errors->first('inspection_report_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
        <label for="type_id" class="form-label">@lang('workshop_order.type')</label>
        <div class="form-group">
            {{ Form::text('type_id', null, ['class' => $error_class
            .'form-control',
            'id' => 'type_id', 'readonly', ]) }}
            @if ($errors->has('type_id'))
                <p class="text-danger">{{$errors->first('type_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
        <label for="category_id" class="form-label">@lang('workshop_order.category')</label>
        <div class="form-group">
            {{ Form::text('category_id', null, ['class' => $error_class
           .'form-control',
           'id' => 'category_id', 'readonly', ]) }}

            @if ($errors->has('category_id'))
                <p class="text-danger">{{$errors->first('category_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('brand_id') ? 'parsley-error ' : ''; @endphp
        <label for="brand_id" class="form-label">@lang('workshop_order.brand')</label>
        <div class="form-group">
            {{ Form::text('brand_id', null, ['class' =>
            $error_class.'form-control', 'id' => 'brand_id', 'readonly', ]) }}
            @if ($errors->has('brand_id'))
                <p class="text-danger">{{$errors->first('brand_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('model_id') ? 'parsley-error ' : ''; @endphp
        <label for="model_id" class="form-label">@lang('workshop_order.model')</label>
        <div class="form-group">
            {{ Form::text('model_id', null, ['class' =>
            $error_class.'form-control', 'id' => 'model_id', 'readonly',]) }}
            @if ($errors->has('model_id'))
                <p class="text-danger">{{$errors->first('model_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('product_id') ? 'parsley-error ' : ''; @endphp
        <label for="product_id" class="form-label">@lang('workshop_order.product')</label>
        <div class="form-group text-uppercase">
            {{ Form::text('product_id', null, ['class' => $error_class.'form-control',
             'id' => 'product_id', 'readonly']) }}
            @if ($errors->has('product_id'))
                <p class="text-danger">{{$errors->first('product_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('registration_number') ? 'parsley-error ' : ''; @endphp
        <label for="registration_number" class="form-label">@lang('inspection_report.registration_divisional_number')</label>
        <div class="form-group">
            {{ Form::text('registration_number', null, ['class' =>
            $error_class.'form-control', 'id' => 'registration_number', 'readonly']) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
        $error_class = $errors->has('workshop_id') ? 'parsley-error ' : ''; @endphp
        <label for="workshop_id" class="form-label">@lang('inspection_report.workshop')</label>
        <div class="form-group">
            {{ Form::text('workshop_id', null, ['class' => $error_class
            .'form-control', 'id' =>
            'workshop_id', 'readonly', ]) }}
            @if ($errors->has('workshop_id'))
                <p class="text-danger">{{$errors->first('workshop_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
        $error_class = $errors->has('fire_station_id') ? 'parsley-error ' : ''; @endphp
        <label for="fire_station_id" class="form-label">@lang('fire_station.fire_station')</label>
        <div class="form-group">
            {{ Form::text('fire_station_id', null, ['class'
             => $error_class.'form-control', 'id' =>
             'fire_station_id', 'readonly']) }}
            @if ($errors->has('fire_station_id'))
                <p class="text-danger">{{$errors->first('fire_station_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
        $error_class = $errors->has('meter_reading') ? 'parsley-error ' : ''; @endphp
        <label for="meter_reading" class="form-label">@lang('repair_job_card.meter_reading')</label>
        <div class="form-group">
            {{ Form::text('meter_reading', null, ['class' => $error_class
            .'form-control', 'id' => 'meter_reading', 'readonly', ]) }}
            @if ($errors->has('meter_reading'))
                <p class="text-danger">{{$errors->first('meter_reading')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
    $error_class = $errors->has('in_date') ? 'parsley-error ' : ''; @endphp
        <label for="in_date" class="form-label">@lang('repair_job_card.in_date')</label>
        <div class="form-group">
            {{ Form::text('in_date', @$repair_job_card->in_date ? date('d-m-Y',strtotime
            ($repair_job_card->in_date)) : null, ['class' => $error_class.'form-control',
            'id' => 'in_date', ]) }}
            @if ($errors->has('in_date'))
                <p class="text-danger">{{$errors->first('in_date')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
    $error_class = $errors->has('out_date') ? 'parsley-error ' : ''; @endphp
        <label for="out_date" class="form-label">@lang('repair_job_card.out_date')</label>
        <div class="form-group">
            {{ Form::text('out_date', @$repair_job_card->out_date ? date('d-m-Y',strtotime
            ($repair_job_card->out_date)) : null, ['class' => $error_class.'form-control',
            'id' => 'out_date', ]) }}
            @if ($errors->has('out_date'))
                <p class="text-danger">{{$errors->first('out_date')}}</p>
            @endif
        </div>
    </div>



    <div class="mt-5">
        <hr>
        <h6 class="font-weight-semibold">@lang('repair_job_card.repair_job_cards')</h6>
        <div v-for="(row,index) in inspection_demand_inputs" id="inspection_demand_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">

                <div class="row" >
                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('fault') ? 'parsley-error ' : '';
                        @endphp
                        <label for="fault" class="form-label">@lang('workshop_order.fault')</label>
                        <div class="form-group">
                            <input v-model="row.fault" class="{{$error_class}} form-control"
                                   :name="'repairJobCardDetails['+index+'][fault]'">
                            @if ($errors->has('fault'))
                                <p class="text-danger">{{$errors->first('fault')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('repair_work') ? 'parsley-error ' : '';
                        @endphp
                        <label for="repair_work" class="form-label">@lang('repair_job_card.demand')</label>
                        <div class="form-group">
                            <input v-model="row.repair_work" class="{{$error_class}} form-control"
                                   :name="'repairJobCardDetails['+index+'][repair_work]'">
                            @if ($errors->has('repair_work'))
                                <p class="text-danger">{{$errors->first('repair_work')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('product_part_id') ? 'parsley-error ' : ''; @endphp
                        <label for="product_part_id" class="form-label">@lang('repair_job_card.issue_product_part')</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <input v-model="row.product_part_id" class="{{$error_class}} form-control"
                                   :name="'repairJobCardDetails['+index+'][product_part_id]'">

                            @if ($errors->has('product_part_id'))
                                <p class="text-danger">{{$errors->first('product_part_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('amount') ? 'parsley-error ' : ''; @endphp
                        <label for="amount" class="form-label">@lang('common.amount')</label>
                        <div class="form-group">
                            <input v-model="row.amount" class="{{$error_class}} form-control"
                                   :name="'repairJobCardDetails['+index+'][amount]'" required="1">
                            {{--                            {{ Form::text('amount', null, ['class' => $error_class.'form-control', 'id' => 'amount', 'required' => false]) }}--}}
                            @if ($errors->has('amount'))
                                <p class="text-danger">{{$errors->first('amount')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('receipt_place') ? 'parsley-error ' : ''; @endphp
                        <label for="receipt_place" class="form-label">@lang('repair_job_card.receipt_place')</label>
                        <div class="form-group">
                            <input v-model="row.receipt_place" class="{{$error_class}} form-control"
                                   :name="'repairJobCardDetails['+index+'][receipt_place]'">
                            @if ($errors->has('receipt_place'))
                                <p class="text-danger">{{$errors->first('receipt_place')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('unit') ? 'parsley-error ' : ''; @endphp
                        <label for="unit_id" class="form-label">@lang('repair_job_card.unit',['model' => trans('repair_job_card.repair_job_card')])</label>
                        <div class="form-group">
                            <select {{--v-model="row.unit_id"--}} :name="'repairJobCardDetails['+index+'][unit]'" class="{{$error_class}} form-control select2vue">
                                <option value="">@lang('common.select_one')</option>
                                <option v-for="(unit,index) in all_units" :value="index"    :selected="index == row.unit">@{{unit}}
                                </option>
                            </select>
                            @if ($errors->has('unit'))
                                <p class="text-danger">{{$errors->first('unit')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('total') ? 'parsley-error ' : ''; @endphp
                        <label for="total" class="form-label">@lang('repair_job_card.total')</label>
                        <div class="form-group">
                            <input v-model="row.total" {{--@change="calculateLineTotal(row)"--}}  class="{{$error_class}} form-control {{--total--}}" type="number"
                                   :name="'repairJobCardDetails['+index+'][total]'" >
                            @if ($errors->has('total'))
                                <p class="text-danger">{{$errors->first('total')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('manpower_number_type') ? 'parsley-error ' : ''; @endphp
                        <label for="manpower_number_type" class="form-label">@lang('repair_job_card.manpower_number_type')</label>
                        <div class="form-group">
                            <input v-model="row.manpower_number_type" class="{{$error_class}} form-control"
                                   :name="'repairJobCardDetails['+index+'][manpower_number_type]'">
                            @if ($errors->has('manpower_number_type'))
                                <p class="text-danger">{{$errors->first('manpower_number_type')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('total_manpower_cost') ? 'parsley-error ' : ''; @endphp
                        <label for="total_manpower_cost" class="form-label">@lang('repair_job_card.total_manpower_cost')</label>
                        <div class="form-group">
                            <input v-model="row.total_manpower_cost" @change="calculateLineTotal(row)" class="{{$error_class}} form-control {{--total_manpower_cost--}}" type="number"
                                   :name="'repairJobCardDetails['+index+'][total_manpower_cost]'">
                            @if ($errors->has('total_manpower_cost'))
                                <p class="text-danger">{{$errors->first('total_manpower_cost')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('total_cost') ? 'parsley-error ' : ''; @endphp
                        <label for="total_cost" class="form-label">@lang('repair_job_card.total_cost')</label>
                        <div class="form-group">
                            <input v-model="row.total_cost" class="{{$error_class}} form-control total_cost"
                                   :name="'repairJobCardDetails['+index+'][total_cost]'" readonly="readonly">
                            @if ($errors->has('total_cost'))
                                <p class="text-danger">{{$errors->first('total_cost')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 my-1">
                        @php /** @var string $errors */
                            $error_class = $errors->has('remarks') ? 'parsley-error ' : ''; @endphp
                        <label for="remarks" class="form-label">@lang('common.remarks')</label>
                        <div class="form-group">
                            <input v-model="row.remarks" class="{{$error_class}} form-control"
                                   :name="'repairJobCardDetails['+index+'][remarks]'">
                            {{--                            {{ Form::text('remarks', null, ['class' => $error_class.'form-control', 'id' => 'remarks', 'required' => false]) }}--}}
                            @if ($errors->has('remarks'))
                                <p class="text-danger">{{$errors->first('remarks')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('repair_job_card.repair_job_card')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('repair_job_card.repair_job_card')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('repair_job_card.repair_job_card')])
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
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('repair_job_card.repair_job_card')])
        </button>
    </div>
</div>

@if(!request()->ajax()) @section('script') @endif
<script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>

<script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
<script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>

<script type="text/javascript">
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
                all_units:{!! @$units !!},
                type: '',
                product_part: '',
                inspection_demand_inputs: [{
                    fault:'',
                    repair_work:'',
                    product_part_id:'',
                    amount:'',
                    receipt_place:'',
                    // unit:'',
                    total:'',
                    manpower_number_type:'',
                    total_manpower_cost:'',
                    total_cost:'',
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
                // addMoreInspectionDemand(){
                //     this.inspection_demand_inputs.push({
                //         name:'',
                //         fault_type_id:'',
                //         fault_category_id:'',
                //         fault_brand_id:'',
                //         fault_model_id:'',
                //         product_part_id:'',
                //         repair_work:'',
                //         amount:'',
                //         comment: '',
                //     });
                // },
                // removeInspectionDemand(index) {
                //     this.inspection_demand_inputs.splice(index, 1);
                // },
                faultSelect(){
                    this.inspection_demand_inputs = {!! @$repair_job_card->repairJobCardDetails ?? '{}' !!}
                },
                load_parameters(){
                    $('#type_id').val('{!! @$repair_job_card->inspectionReport->workshopOrder->product->type->bn_name !!}')
                    $('#category_id').val('{!! @$repair_job_card->inspectionReport->workshopOrder->product->category->bn_name !!}')
                    $('#brand_id').val('{!! @$repair_job_card->inspectionReport->workshopOrder->product->brand->bn_name !!}')
                    $('#model_id').val('{!! @$repair_job_card->inspectionReport->workshopOrder->product->model->bn_name !!}')
                    $('#product_id').val('{!! @$repair_job_card->inspectionReport->workshopOrder->product->tracking_no !!}')
                    $('#registration_number').val('{!! @$repair_job_card->inspectionReport->workshopOrder->product->registration_number !!}')
                    $('#workshop_id').val('{!! @$repair_job_card->inspectionReport->workshopOrder->workshop->bn_name !!}')
                    $('#fire_station_id').val('{!! @$repair_job_card->inspectionReport->workshopOrder->product->fire_station->bn_name !!}')
                    $('#meter_reading').val('{!! @$repair_job_card->inspectionReport->workshopOrder->mileage !!}')


                    //for dependent child data
                    this.inspection_demand_inputs = {!! @$repair_job_card->repairJobCardDetails ?? '{}' !!}
                },

                calculateLineTotal(row) {
                    let line_total = parseFloat(row.total) + parseFloat(row.total_manpower_cost);
                    if (!isNaN(line_total)) {
                        row.total_cost = line_total.toFixed(2);
                    }
                },
            },
            created() {
            },
            mounted() {
                $(document).trigger('vue-loaded');
                // $('.total_manpower_cost').on('change', function() {
                //      let totalValue =  $('.total').val();
                //     let totalManpowerValue =  $('.total_manpower_cost').val();
                //     let totalCostValue = parseInt(totalValue) + parseInt(totalManpowerValue);
                //     $('.total_cost').val(totalCostValue)
                // });
                @if(\Route::currentRouteName() == 'repair_job_card.edit')
                    this.load_parameters()
                @endif
            },
            updated() {
                $(document).trigger('vue-loaded');
                make_bangla()
            },
        });


        $('#inspection_report_id').on('change', function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            let id = $('#inspection_report_id').val();
            $.ajax({
                url: '{{route('inspection_report_product')}}',
                type: 'post',
                dataType: 'JSON',
                data : {id: id},
                cache: false,
                success: function (response) {
                    // console.log(response)

                    $('#type_id').val(response.workshop_order.product.type.bn_name)
                    $('#category_id').val(response.workshop_order.product.category.bn_name)
                    $('#brand_id').val(response.workshop_order.product.brand.bn_name)
                    $('#model_id').val(response.workshop_order.product.model.bn_name)
                    $('#product_id').val(response.workshop_order.product.tracking_no)
                    $('#registration_number').val(response.workshop_order.product.registration_number)
                    $('#workshop_id').val(response.workshop_order.workshop.bn_name)
                    $('#fire_station_id').val(response.workshop_order.product.fire_station.bn_name)
                    $('#meter_reading').val(response.workshop_order.mileage)
                    vue.inspection_demand_inputs = response.demands

                    $.each(response.demands, function( index, value ) {
                        this.product_part_id = value.product_part.tracking_no;
                        // console.log(value.product_part.tracking_no);
                    });

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

@include('admin.layouts.partial.footer.vue_loaded_script')

@if(!request()->ajax()) @endsection @endif
