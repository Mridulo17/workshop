@section('css')
    #loader{
    display: block;
    }
@endsection
<div id="vue">
    <div class="row mb-3">
        @if(@$product_part->tracking_no)
            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('tracking_no') ? 'parsley-error ' : ''; @endphp
                <label for="tracking_no" class="form-label">@lang('common.tracking_no')</label>
                <div class="form-group">
                    {{ Form::text('', $product_part->tracking_no, ['class' => $error_class.'form-control text-uppercase','readonly' => true]) }}
                    @if ($errors->has('tracking_no'))
                        <p class="text-danger">{{$errors->first('tracking_no')}}</p>
                    @endif
                </div>
            </div>
        @endif

        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('type') ? 'parsley-error ' : ''; @endphp
            <label for="type" class="form-label">@lang('product.type')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::select('type_id', $types, null, ['class' => $error_class.'form-control type_id', 'placeholder' => trans('product.select_one'), 'id' => 'type', 'v-on:change' => 'toggleType', 'v-model' => 'type_id', 'onchange' => 'SelectChange("'.route('get_categories_by_type').'","category_id",this)', 'required' => 1]) }}
                @if ($errors->has('type'))
                    <p class="text-danger">{{$errors->first('type')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
            <label for="category_id" class="form-label">@lang('category.category')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group input-group">
                <select name="category_id" id="category_id" v-model="category_id" class="{{$error_class}} form-control select2vue category_id" required="1">
                    <option value="">@lang('common.select_one')</option>
                    <option v-for="(category,index) in categories" :value="index">@{{category}}</option>
                </select>
                <a href="{{route('category.create')}}" class="input-group-text modal_lg_button text-secondary" parent="type_id">
                    <i class="fa fa-plus-circle"></i>
                </a>
                @if ($errors->has('category_id'))
                    <p class="text-danger">{{$errors->first('category_id')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('brand_id') ? 'parsley-error ' : ''; @endphp
            <label for="brand_id" class="form-label">@lang('product.brand')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group input-group">
                <select name="brand_id" class="{{$error_class}} form-control select2vue brand_id" onchange=SelectChange("{{route('get_models')}}","model_id",this) required autofocus>
                    <option value="">@lang('common.select')</option>
                    <option v-for="(brand,index) in brands" :value="index" :selected="index == brand_id">@{{brand}}</option>
                </select>
                <a href="{{route('brand_create_modal')}}" class="input-group-text modal_lg_button text-secondary">
                    <i class="fa fa-plus-circle"></i>
                </a>
                @if ($errors->has('brand_id'))
                    <p class="text-danger">{{$errors->first('brand_id')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('model_id') ? 'parsley-error ' : ''; @endphp
            <label for="model_id" class="form-label">@lang('product.model')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group input-group">
                <select name="model_id" class="{{$error_class}} form-control select2vue model_id" required>
                    <option value="">@lang('common.select')</option>
                    <option v-for="(model,index) in models" :value="index" :selected="index == model_id">@{{model}}</option>
                </select>
                <a href="{{route('model_create_modal')}}" class="input-group-text modal_lg_button text-secondary" parent="brand_id">
                    <i class="fa fa-plus-circle"></i>
                </a>
                @if ($errors->has('model_id'))
                    <p class="text-danger">{{$errors->first('model_id')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('unit_id') ? 'parsley-error ' : ''; @endphp
            <label for="unit_id" class="form-label">@lang('product_part.unit')</label>
            <div class="form-group">
                {{ Form::select('unit_id', $units, null, ['class' => $error_class.'form-control select2vue', 'id' => 'unit_id', 'placeholder' => trans('common.select'), 'required' => false]) }}
                @if ($errors->has('unit_id'))
                    <p class="text-danger">{{$errors->first('unit_id')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('registration_number') ? 'parsley-error ' : ''; @endphp
            <label for="registration_number" class="form-label">@lang('product_part.registration_number')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::text('registration_number', null, ['class' => $error_class.'form-control', 'id' => 'registration_number', 'required' => 1]) }}
                @if ($errors->has('registration_number'))
                    <p class="text-danger">{{$errors->first('registration_number')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('material') ? 'parsley-error ' : ''; @endphp
            <label for="material" class="form-label">@lang('product_part.material')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::text('material', null, ['class' => $error_class.'form-control', 'id' => 'material', 'required' => 1]) }}
                @if ($errors->has('material'))
                    <p class="text-danger">{{$errors->first('material')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('material_type') ? 'parsley-error ' : ''; @endphp
            <label for="material_type" class="form-label">@lang('product_part.material_type')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::select('material_type', \App\Models\Material::type(), null, ['class' => $error_class.'form-control select2vue', 'id' => 'material_type', 'placeholder' => trans('common.select'), 'required' => 1]) }}
                @if ($errors->has('material_type'))
                    <p class="text-danger">{{$errors->first('material_type')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('parts') ? 'parsley-error ' : ''; @endphp
            <label for="parts" class="form-label">@lang('product_part.parts')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::select('parts', \App\Models\Material::parts(), null, ['class' => $error_class.'form-control', 'placeholder' => trans('common.select'), 'v-model' => 'parts' , 'v-on:change' => 'toggleProducts' , 'required' => 1]) }}
                @if ($errors->has('parts'))
                    <p class="text-danger">{{$errors->first('parts')}}</p>
                @endif
            </div>
        </div>

        {{--{{ dd($product_part->products) }}--}}
        <div class="col-sm-12 col-md-4 my-2" v-if="isProduct">
            @php /** @var string $errors */
        $error_class = $errors->has('products') ? 'parsley-error ' : ''; @endphp
            <label for="parts" class="form-label">@lang('product_part.products')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::select('product_part_models[]', $parts_models, @$product_part->product_part_models ? $product_part_models : null, ['class' => $error_class.'form-control select2vue', 'data-placeholder' => trans('common.select'), 'multiple' => 'multiple', 'required' => 1]) }}
                @if ($errors->has('products'))
                    <p class="text-danger">{{$errors->first('products')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
        $error_class = $errors->has('weight') ? 'parsley-error ' : ''; @endphp
            <label for="weight" class="form-label">@lang('product_part.weight')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::text('weight', null, ['class' => $error_class.'form-control', 'required' => 1]) }}
                @if ($errors->has('weight'))
                    <p class="text-danger">{{$errors->first('weight')}}</p>
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
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <h6 class="font-weight-semibold">@lang('variant.variation')</h6>
            <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                <thead>
                <tr>
                    <th>@lang('variant.type')</th>
                    <th width="40%">@lang('variant.variant')</th>
                    <th width="15%">@lang('variant.action')</th>
                </tr>
                </thead>
                <tbody class="variation_tbody">
                <tr class="variation_tr" v-for="(row,index) in product_part_variant_inputs">
                    <td>
                        <select class="{{$error_class}} form-control select2vue variant_type_id" :name="'product_part_variants['+index+'][variant_type_id]'" onchange='SelectChange("{{route('get_variants')}}","variant_id",this)' required>
                            <option value="">@lang('common.select')</option>
                            <option v-for="(variant_type,index) in variant_types" :value="index" :selected="index == row.variant_type_id">@{{variant_type}}</option>
                        </select>
                    </td>

                    <td>
                        <select class="{{$error_class}} form-control select2vue variant_id" :name="'product_part_variants['+index+'][variant_id]'" required>
                            <option value="">@lang('common.select')</option>
                            <option v-for="(variant,index) in row.variants" :value="variant.id" :selected="variant.id == row.variant_id">@{{variant.bn_name}}</option>
                        </select>
                    </td>
                    <td>
                        <button {{--v-if="index != 0"--}} type="button" class="btn btn-danger float-end" @click="removeProductPartVariant(row)"><i class="fas fa-times text-warning"></i> {{trans('variant.delete')}}</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-right">
            <a href="javascript:" class="btn btn-outline-pink"  @click="addMoreProductPartVariant">
                <i class="fa fa-plus-circle"></i>
                @lang('variant.add_variant')
            </a>
        </div>
    </div>



    <h5 class="d-inline-block">
        <strong>@lang('common.location')</strong>
    </h5>
    <div class="border border-secondary mb-4 p-3">
        <div class="row">
            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
        $error_class = $errors->has('workshop_id') ? 'parsley-error ' : ''; @endphp
                <label for="workshop_id" class="form-label">@lang('workshop.workshop')</label>
                <sup class="text-danger">*</sup>
                <div class="form-group">
                    {{ Form::select('workshop_id', $workshops, null, ['class' => $error_class.'form-control select2vue', 'id' => 'workshop_id', 'placeholder' => trans('common.select'), 'onchange' => 'SelectChange("'.route('get_fire_stations_by_workshop').'","fire_station_id",this)', 'required' => true]) }}
                    @if ($errors->has('workshop_id'))
                        <p class="text-danger">{{$errors->first('workshop_id')}}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('fire_station_id') ? 'parsley-error ' : ''; @endphp
                <label for="fire_station_id" class="form-label">@lang('fire_station.fire_station')</label>
                <sup class="text-danger">*</sup>
                <div class="form-group">
                    {{ Form::select('fire_station_id', $fire_stations, null, ['class' => $error_class.'form-control select2vue fire_station_id', 'id' => 'fire_station_id', 'placeholder' => trans('common.select'), 'required' => true]) }}
                    @if ($errors->has('fire_station_id'))
                        <p class="text-danger">{{$errors->first('fire_station_id')}}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('section') ? 'parsley-error ' : ''; @endphp
                <label for="section" class="form-label">@lang('common.section')</label>
                <div class="form-group">
                    {{ Form::text('section', null, ['class' => $error_class.'form-control', 'id' => 'section', 'required' => false]) }}
                    @if ($errors->has('section'))
                        <p class="text-danger">{{$errors->first('section')}}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('building') ? 'parsley-error ' : ''; @endphp
                <label for="building" class="form-label">@lang('common.building')</label>
                <div class="form-group">
                    {{ Form::text('building', null, ['class' => $error_class.'form-control', 'id' => 'building', 'required' => false]) }}
                    @if ($errors->has('building'))
                        <p class="text-danger">{{$errors->first('building')}}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('floor') ? 'parsley-error ' : ''; @endphp
                <label for="floor" class="form-label">@lang('common.floor')</label>
                <div class="form-group">
                    {{ Form::text('floor', null, ['class' => $error_class.'form-control', 'id' => 'floor', 'required' => false]) }}
                    @if ($errors->has('floor'))
                        <p class="text-danger">{{$errors->first('floor')}}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('block') ? 'parsley-error ' : ''; @endphp
                <label for="block" class="form-label">@lang('common.block')</label>
                <div class="form-group">
                    {{ Form::text('block', null, ['class' => $error_class.'form-control', 'id' => 'block', 'required' => false]) }}
                    @if ($errors->has('block'))
                        <p class="text-danger">{{$errors->first('block')}}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('rack') ? 'parsley-error ' : ''; @endphp
                <label for="rack" class="form-label">@lang('common.rack')</label>
                <div class="form-group">
                    {{ Form::text('rack', null, ['class' => $error_class.'form-control', 'id' => 'rack', 'required' => false]) }}
                    @if ($errors->has('rack'))
                        <p class="text-danger">{{$errors->first('rack')}}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('row') ? 'parsley-error ' : ''; @endphp
                <label for="row" class="form-label">@lang('common.row')</label>
                <div class="form-group">
                    {{ Form::text('row', null, ['class' => $error_class.'form-control', 'id' => 'row', 'required' => false]) }}
                    @if ($errors->has('row'))
                        <p class="text-danger">{{$errors->first('row')}}</p>
                    @endif
                </div>
            </div>

            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('column') ? 'parsley-error ' : ''; @endphp
                <label for="column" class="form-label">@lang('common.column')</label>
                <div class="form-group">
                    {{ Form::text('column', null, ['class' => $error_class.'form-control', 'id' => 'column', 'required' => false]) }}
                    @if ($errors->has('column'))
                        <p class="text-danger">{{$errors->first('column')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="border border-secondary my-4 p-3">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="my-file">@lang('common.select_image')</label>
                    <input type="file" accept="image/*" multiple="multiple" @change="previewMultiImage" class="form-control" id="images">
                </div>
            </div>
        </div>

        <div class="row" v-if="preview_list.length">
            <div class="col-md-4 col-sm-12 my-3" v-for="image, index in preview_list" :key="index">
                <a class="btn btn-danger btn-sm mb-1" @click="removeImage(index,image.id)">
                    <i class="fa fa-times"></i> <strong>@lang('common.delete')</strong>
                </a>
                <img :src="image.id ? '/'+image.source : image.source" class="img-fluid image_border p-2" />
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('product_part.product_part')])
            </button>
        </div>
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
            Vue.directive('select', {
                twoWay: true,
                beforeMount: function (el, binding, vnode) {
                    $(el).select2().on("select2:select", (e) => {
                        // v-model looks for
                        //  - an event named "change"
                        //  - a value with property path "$event.target.value"
                        el.dispatchEvent(new Event('change', {target: e.target}));
                    });
                },
                updated: function(el, me) {
                    // update the selection if the value is changed externally
                    $(el).trigger("change");
                }
            });

            let vue = new Vue({
                el: '#vue',
                data: {
                    parts: '{!! @$product_part->parts ?? '' !!}',
                    isProduct: false,
                    type_id : '{!! @$product->type_id ? $product->type_id : '' !!}',
                    category_id : '{!! @$product->category_id ? $product->category_id : '' !!}',
                    brand_id : '{!! @$product_part->brand_id ? $product_part->brand_id : '' !!}',
                    model_id : '{!! @$product_part->model_id ? $product_part->model_id : '' !!}',
                    brands: {!! $brands !!},
                    variants: {},
                    variant_types: {!! $variant_types !!},
                    models: {!! @$models ?? '{}' !!},
                    product_part_variant_inputs: [{
                        variant_type_id: '',
                        variant_id: '',
                    }],
                    preview_list: [],
                    image_list: [],
                    delete_images: [],
                },
                methods: {
                    addMoreProductPartVariant(){
                        if(response.categories){
                            this.categories = []
                            this.categories = response.categories
                            this.category_id = response.category.id
                            this.type_id = response.category.type_id
                        }
                        this.product_part_variant_inputs.push({
                            variant_type_id: '',
                            variant_id: '',
                        });
                    },
                    removeProductPartVariant(row) {
                        this.product_part_variant_inputs.splice(this.product_part_variant_inputs.indexOf(row), 1);
                    },
                    previewMultiImage: function(event) {
                        var input = event.target;
                        var count = input.files.length;
                        var index = 0;
                        if (input.files) {
                            while(count --) {
                                var reader = new FileReader();
                                reader.onload = (e) => {
                                    this.preview_list.push(
                                        {'source' : e.target.result}
                                    );
                                }
                                this.image_list.push(input.files[index]);
                                reader.readAsDataURL(input.files[index]);
                                index ++;
                            }
                        }

                    },

                    removeImage(index, image_id = null){
                        this.preview_list.splice(index, 1);
                        if(image_id){
                            this.delete_images.push(image_id);
                        }else{
                            this.image_list.splice(index, 1);
                        }

                    },
                    load_parameters(){

                        let vm = this;
                        let slug = vm.parts;

                        if(slug === "generic"){
                            vm.isProduct=false;
                        } else if(slug === "specific"){
                            vm.isProduct=true;
                        }

                        this.product_part_variant_inputs = {!! $product_part->product_part_variants ?? '{}' !!}

                        this.preview_list = {!! $product_part->files ?? '{}' !!}

                    },
                    toggleProducts() {
                        let vm = this;
                        vm.isProduct=false;
                        let slug = vm.parts;

                        if(slug === "generic"){
                            vm.isProduct=false;
                        } else if(slug === "specific"){
                            vm.isProduct=true;
                        }
                    },
                    getResponseDataFromAjax(response){
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
                },
                created() {
                    window.vue_data = this;
                },
                mounted() {
                    @if(\Route::currentRouteName() == 'product_part.edit')
                        this.load_parameters()
                    @endif
                    $('.select2vue').select2({});

                    $('#loader').hide();
                },
                updated() {
                    $('.select2vue').select2({});
                },
            });

        });

        $(document).on('submit', '#product_part_form', function (event) {
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

            let vue_data = window.vue_data
            let images = vue_data.image_list
            var formData = new FormData(this);
            let total_images =images.length; //Total Images
            for (let i = 0; i < total_images; i++) {
                formData.append('images[]', images[i]);
            }
            formData.append('total_images', total_images);
            formData.append('delete_images', vue_data.delete_images);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    window.location.href = '{{route('product_part.index')}}'
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
@endsection
