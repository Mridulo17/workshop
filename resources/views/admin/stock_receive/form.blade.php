@section('css')
    #loader{
        display: block;
    }
@endsection
<div class="row mb-3">
    @if(@$stock_receive->tracking_no)
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('tracking_no') ? 'parsley-error ' : ''; @endphp
            <label for="tracking_no" class="form-label">@lang('stock_receive.tracking_no')</label>
            <div class="form-group">
                {{ Form::text('', $stock_receive->tracking_no, ['class' => $error_class.'form-control','readonly' => true]) }}
                @if ($errors->has('tracking_no'))
                    <p class="text-danger">{{$errors->first('tracking_no')}}</p>
                @endif
            </div>
        </div>
    @endif

    @if(auth()->user()->workshop_id)
        {{ Form::hidden('workshop_id', auth()->user()->workshop_id,[ 'id' => 'workshop_id']) }}
    @else
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('workshop_id') ? 'parsley-error ' : ''; @endphp
            <label for="workshop_id" class="form-label">@lang('workshop.workshop')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::select('workshop_id', $workshops, null, ['class' => $error_class.'form-control select2', 'id' => 'workshop_id', 'placeholder' => trans('common.select'), /*'onchange' => "showItemSection()",*/ 'required' => true]) }}
                @if ($errors->has('workshop_id'))
                    <p class="text-danger">{{$errors->first('workshop_id')}}</p>
                @endif
            </div>
        </div>
    @endif

    @if(auth()->user()->fire_station_id)
        {{ Form::hidden('fire_station_id', auth()->user()->fire_station_id,[ 'id' => 'fire_station_id']) }}
    @else
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('fire_station_id') ? 'parsley-error ' : ''; @endphp
            <label for="fire_station_id" class="form-label">@lang('fire_station.fire_station')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::select('fire_station_id', $fire_stations, null, ['class' => $error_class.'form-control select2', 'id' => 'fire_station_id', 'placeholder' => trans('common.select'), /*'onchange' => "showItemSection()",*/ 'required' => true]) }}
                @if ($errors->has('fire_station_id'))
                    <p class="text-danger">{{$errors->first('fire_station_id')}}</p>
                @endif
            </div>
        </div>
    @endif

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
        $error_class = $errors->has('supplier_id') ? 'parsley-error ' : ''; @endphp
        <label for="supplier_id" class="form-label">@lang('supplier.supplier')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('supplier_id', $suppliers, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('common.select'), 'required' => true]) }}
            @if ($errors->has('supplier_id'))
                <p class="text-danger">{{$errors->first('supplier_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
        $error_class = $errors->has('received_date') ? 'parsley-error ' : ''; @endphp
        <label for="received_date" class="form-label">@lang('stock_receive.received_date')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group input-group">
            {{ Form::text('received_date', @$stock_receive->received_date ? date('d-m-Y',strtotime($stock_receive->received_date)) : null, ['class' => $error_class.'form-control datepicker', 'autocomplete' => 'off', 'required' => true]) }}

            <a href="javascript:" class="input-group-text text-secondary show_calendar">
                <i class="fa fa-calendar"></i>
            </a>
            @if ($errors->has('received_date'))
                <p class="text-danger">{{$errors->first('received_date')}}</p>
            @endif
        </div>
    </div>
</div>

<hr>
<div>
    <div id="vue_app">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <h6 class="font-weight-semibold">@lang('stock_receive.stock_receive_item')</h6>
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>
                                @lang('stock_receive.type')
                                <sup class="text-danger">*</sup>
                            </th>
                            <th>
                                @lang('model.model')
                                <sup class="text-danger">*</sup>
                            </th>
                            <th>
                                @lang('stock_receive.item')
                                <sup class="text-danger">*</sup>
                            </th>
                            <th>
                                @lang('stock_receive.received_qty')
                                <sup class="text-danger">*</sup>
                            </th>
                            <th>
                                @lang('stock_receive.current_qty')
                            </th>
                            <th width="10%" class="text-center">@lang('stock_receive.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(row,index) in stock_receive_items" class="stock_receive_item_row">
                            <td>
                                <div v-if="row.type != 'product'">
                                    <span>{{\App\Models\StockReceive::findType('product_part')}}</span>
                                    <input type="hidden" class="type" :name="'stock_receive_item['+index+'][type]'" v-model="row.type">
                                </div>

                                <div v-if="row.type == 'product'">
                                    <span>@{{row.item.type.bn_name}}</span>
                                    <input type="hidden" :name="'stock_receive_item['+index+'][type]'" :value="row.type">
                                </div>
                            </td>
                            <td>
                                <div v-if="row.type != 'product'">
                                    <select class="form-control model_id select2vue" :name="'stock_receive_item['+index+'][model_id]'" onchange = SelectChange("{{route('get_product_part_by_model')}}","itemable_id",this) required>
                                        <option value="">@lang('common.select_one')</option>
                                        <option v-for="(model,model_index) in models" :value="model_index" :selected="model_index == row.model_id">@{{model}}</option>
                                    </select>
                                </div>

                                <div v-if="row.type == 'product'">
                                    <span>@{{row.model.bn_name}}</span>
                                    <input type="hidden" :name="'stock_receive_item['+index+'][model_id]'" :value="row.model_id">
                                </div>
                            </td>
                            <td>
                                <div v-if="row.type != 'product'">
                                    <select class="form-control select2vue itemable_id" :name="'stock_receive_item['+index+'][itemable_id]'" onchange="getItemQty('{{route('get_item_qty_by_type')}}',this)" required>
                                        <option value="">@lang('common.select_one')</option>
                                        <option v-for="(item,item_index) in row.items" :value="item_index" :selected="item_index == row.itemable_id">@{{item}}</option>
                                    </select>

                                    <input type="hidden" :name="'stock_receive_item['+index+'][itemable_type]'" v-model="row.itemable_type" class="itemable_type" v-if="row.itemable_type !== ''" >

                                    <input type="hidden" :name="'stock_receive_item['+index+'][itemable_type]'" class="itemable_type" v-if="row.itemable_type === ''" >
                                </div>
                                <div v-if="row.type == 'product'">
                                    <span>@{{row.item.tracking_no}}</span>
                                    <input type="hidden" :name="'stock_receive_item['+index+'][itemable_id]'" v-model="row.itemable_id" class="itemable_type">
                                    <input type="hidden" :name="'stock_receive_item['+index+'][itemable_type]'" v-model="row.itemable_type" class="itemable_type">
                                </div>
                            </td>
                            <td>
                                <div v-if="row.type != 'product'">
                                    <input :name="'stock_receive_item['+index+'][received_qty]'" v-model="row.received_qty" type="text" class="form-control received_qty" pattern="{{$number_pattern}}" v-if="row.received_qty !== ''" required>
                                    <input :name="'stock_receive_item['+index+'][received_qty]'" type="text" class="form-control received_qty" pattern="{{$number_pattern}}" v-if="row.received_qty === ''" required>
                                </div>
                                <div v-if="row.type == 'product'">
                                    <input :name="'stock_receive_item['+index+'][received_qty]'" v-model="row.received_qty" type="text" class="form-control received_qty" readonly>
                                </div>
                            </td>
                            <td>
                                <input :name="'stock_receive_item['+index+'][current_qty]'" v-model="row.current_qty" type="text" class="form-control current_qty" v-if="row.current_qty !== ''" readonly>

                                <input :name="'stock_receive_item['+index+'][current_qty]'" type="text" class="form-control current_qty h" v-if="row.current_qty === ''" readonly>
                            </td>
                            <td>
                                <a v-if="index != 0" type="button" class="btn btn-danger float-end" onclick="RemoveItem(this.parentNode.parentNode)">
                                    <i class="fas fa-times text-warning"></i> {{trans('common.delete')}}
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" v-if="item_add_button">
                <div class="col-sm-12 text-right">
                    <a href="javascript:" class="btn btn-outline-pink" @click="addMoreItem">
                        <i class="fa fa-plus-circle"></i>
                        @lang('stock_receive.add_item')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('stock_receive.stock_receive')])
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
            let vue_app = new Vue({
                el: '#vue_app',
                data: {
                    types : {!! collect(\App\Models\StockReceive::types()) !!},
                    models : {!! $models !!},
                    stock_receive_items : [{
                        'type' : 'product_part',
                        'itemable_type' : '',
                        'received_qty' : '',
                        'current_qty' : '',
                    }],
                    products: {!! @$products !!},
                    product_parts: {!! @$product_parts !!},
                    is_workshop: false,
                    is_fire_station: false,
                    item_add_button: true,
                },
                methods: {
                    addMoreItem(){
                        this.stock_receive_items.push({
                            'type' : 'product_part',
                            'itemable_type' : '',
                            'received_qty' : '',
                            'current_qty' : '',
                        });
                    },
                    load_parameters(){
                        let vm = this;
                        this.stock_receive_items = {!! @$stock_receive->stock_receive_items ?? '{}' !!}
                        if(this.stock_receive_items[0].type == 'product'){
                            this.item_add_button = false
                        }
                    },
                },
                created() {
                    window.vue_data = this;
                    @if(@$stock_receive)
                        this.load_parameters()
                    @endif
                },
                mounted() {
                    $(document).trigger('vue-loaded');

                    @if((auth()->user()->workshop_id && auth()->user()->fire_station_id) || @$stock_receive)
                        this.is_workshop = true
                    this.is_fire_station = true
                    @endif

                    $('#loader').hide();
                },
                updated() {
                    $(document).trigger('vue-loaded');
                },
            });

        });
    </script>

    <script>
        function showItemSection(){
            let workshop_id = $('#workshop_id').val()
            let fire_station_id = $('#fire_station_id').val()
            $('.stock_receive_item_row').find('input').val('');
            $(".itemable_id option").prop("selected", false);
            $("select").select2()
            if(workshop_id){
                window.vue_data.is_workshop = true
            }else{
                window.vue_data.is_workshop = false
            }
        }

        function getItemQty(url, Object){
            $('#loader').show()
            let vm = $(Object)
            let value = vm.val()
            let type = vm.parent().parent().parent().find('.type').val()
            let workshop_id = $('#workshop_id').val()
            let fire_station_id = $('#fire_station_id').val()
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:  url,
                type: 'post',
                dataType: 'json',
                data : {
                    workshop_id: workshop_id,
                    fire_station_id: fire_station_id,
                    type: type,
                    id: value,
                },
                cache: false,
                success: function (response) {
                    vm.parent().parent().parent().find('.current_qty').val(response.total_qty)
                    vm.parent().find('.itemable_type').val(response.model)
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
        }

        $(document).on('submit', '#stock_receive_form', function (event) {
            $('#loader').show();
            let ajax_error_alert = $('#ajax_error_alert')
            let ajax_error = ajax_error_alert.find('#ajax_error')
            ajax_error.text('')
            ajax_error_alert.addClass('d-none');
            event.preventDefault();
            let vm = $(this)
            let input_array = ['input', 'select']
            vm.find('.parsley-errors-list').remove();
            input_array.forEach(function (value, index) {
                vm.find(value).removeClass('parsley-error');
            });
            let data = $(this).serialize();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                data: data,
                success: function (response) {
                    window.location.href = '{{route('stock_receive.index')}}'
                    setTimeout(function(){
                        $('#loader').hide();
                    }, 280);
                },
                error: function (xhr) {
                    ajax_error_alert.removeClass('d-none');
                    if(xhr.status == 500 && xhr.responseJSON){
                        ajax_error.text(xhr.responseJSON);
                    }
                    if(xhr.responseJSON && xhr.responseJSON.exception){
                        ajax_error.text(xhr.responseJSON.message);
                    }
                    if(xhr.responseJSON && xhr.responseJSON.errors){
                        let errors = Object.entries(xhr.responseJSON.errors);
                        for(let error of errors){
                            ajax_error.text(error[1]);
                            break
                        }

                        let flag = 0;
                        for(let error of errors){

                            if (flag === 0){
                                $('html, body').animate({
                                    scrollTop: $('input[name='+error[0]+'], select[name='+error[0]+'], textarea[name='+error[0]+']').offset().top - 500
                                }, 500);
                                flag = 1
                            }

                            input_array.forEach(function (value, index) {
                                let input = $(value+'[name='+error[0]+']');
                                vm.find(input).addClass('parsley-error');
                                vm.find(input).after(
                                    '<ul class="parsley-errors-list filled" aria-hidden="false">' +
                                    '<li class="parsley-required">'+error[1]+'</li>' +
                                    '</ul>'
                                );
                            });
                        }
                    }
                    setTimeout(function(){
                        $('#loader').hide();
                    }, 280);
                }
            });
        });
    </script>

    @include('admin.layouts.partial.footer.vue_loaded_script')
@endsection
