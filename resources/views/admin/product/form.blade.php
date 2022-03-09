@section('css')
    #loader{
    display: block;
    }
@endsection
<div id="vue">
    <div class="row mb-3">
        @if(@$product->tracking_no)
            <div class="col-sm-12 col-md-4 my-2">
                @php /** @var string $errors */
            $error_class = $errors->has('tracking_no') ? 'parsley-error ' : ''; @endphp
                <label for="tracking_no" class="form-label">@lang('common.tracking_no')</label>
                <div class="form-group">
                    {{ Form::text('', $product->tracking_no, ['class' => $error_class.'form-control text-uppercase','readonly' => true]) }}
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
                <select name="brand_id" v-model="brand_id" class="{{$error_class}} form-control select2vue brand_id" onchange = SelectChange("{{route('get_models')}}","model_id",this) required="1">
                    <option value="">@lang('product.select_one')</option>
                    <option v-for="(brand,index) in brands" :value="index">@{{brand}}</option>
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
                <select name="model_id" id="model_id" v-model="model_id" class="{{$error_class}} form-control select2vue model_id" required="1">
                    <option value="">@lang('product.select_one')</option>
                    <option v-for="(model,index) in models" :value="index">@{{model}}</option>
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
            $error_class = $errors->has('country_id') ? 'parsley-error ' : ''; @endphp
            <label for="country_id" class="form-label">@lang('product.country')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group">
                {{ Form::select('country_id', $countries, null, ['class' => $error_class.'form-control select2vue', 'placeholder' => trans('product.select_one'), 'required' => 1]) }}
                @if ($errors->has('country_id'))
                    <p class="text-danger">{{$errors->first('country_id')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('manufacturer_year') ? 'parsley-error ' : ''; @endphp
            <label for="manufacturer_year" class="form-label">@lang('product.manufacturer_year')</label>
            <div class="form-group input-group">
                {{ Form::text('manufacturer_year', @$product->manufacturer_year, ['class' => $error_class.'form-control yearpicker', 'autocomplete' => 'off', 'required' => false]) }}

                <a href="javascript:" class="input-group-text text-secondary show_year_calendar">
                    <i class="fa fa-calendar"></i>
                </a>
                @if ($errors->has('manufacturer_year'))
                    <p class="text-danger">{{$errors->first('manufacturer_year')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('entry_date') ? 'parsley-error ' : ''; @endphp
            <label for="entry_date" class="form-label">@lang('product.entry_date')</label>
            <div class="form-group input-group">
                {{ Form::text('entry_date', @$product->entry_date ? date('d-m-Y',strtotime($product->entry_date)) : null, ['class' => $error_class.'form-control datepicker', 'autocomplete' => 'off', 'required' => false]) }}

                <a href="javascript:" class="input-group-text text-secondary show_calendar">
                    <i class="fa fa-calendar"></i>
                </a>
                @if ($errors->has('entry_date'))
                    <p class="text-danger">{{$errors->first('entry_date')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('registration_number') ? 'parsley-error ' : ''; @endphp
            <label for="registration_number" class="form-label">
                @lang('product.registration_divisional')
                @lang('product.number')</label>
            <div class="form-group">
                {{ Form::text('registration_number', null, ['class' => $error_class.'form-control', 'id' => 'registration_number', 'required' => false]) }}
                @if ($errors->has('registration_number'))
                    <p class="text-danger">{{$errors->first('registration_number')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('capacity') ? 'parsley-error ' : ''; @endphp
            <label for="capacity" class="form-label">@lang('product.capacity')</label>
            <div class="form-group">
                {{ Form::text('capacity', null, ['class' => $error_class.'form-control', 'id' => 'capacity']) }}
                @if ($errors->has('capacity'))
                    <p class="text-danger">{{$errors->first('capacity')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('fuel') ? 'parsley-error ' : ''; @endphp
            <label for="fuel" class="form-label">@lang('product.fuel')</label>
            <div class="form-group">
                {{ Form::select('fuel', \App\Models\Product::fuels(), null, ['class' => $error_class.'form-control', 'placeholder' => trans('product.select_one')]) }}
                @if ($errors->has('fuel'))
                    <p class="text-danger">{{$errors->first('fuel')}}</p>
                @endif
            </div>
        </div>
{{--        <div class="col-sm-12 col-md-4 my-2">--}}
{{--            @php /** @var string $errors */--}}
{{--            $error_class = $errors->has('divisional_number') ? 'parsley-error ' : ''; @endphp--}}
{{--            <label for="divisional_number" class="form-label">@lang('product.divisional_number')</label>--}}
{{--            <div class="form-group">--}}
{{--                {{ Form::text('divisional_number', null, ['class' => $error_class.'form-control', 'id' => 'divisional_number']) }}--}}
{{--                @if ($errors->has('divisional_number'))--}}
{{--                    <p class="text-danger">{{$errors->first('divisional_number')}}</p>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('engine_number') ? 'parsley-error ' : ''; @endphp
            <label for="engine_number" class="form-label">@lang('product.engine_number')</label>
            <div class="form-group">
                {{ Form::text('engine_number', null, ['class' => $error_class.'form-control', 'id' => 'engine_number', 'required' => false]) }}
                @if ($errors->has('engine_number'))
                    <p class="text-danger">{{$errors->first('engine_number')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('chassis_number') ? 'parsley-error ' : ''; @endphp
            <label for="chassis_number" class="form-label">@lang('product.chassis_number')</label>
            <div class="form-group">
                {{ Form::text('chassis_number', null, ['class' => $error_class.'form-control', 'id' => 'chassis_number', 'required' => false]) }}
                @if ($errors->has('chassis_number'))
                    <p class="text-danger">{{$errors->first('chassis_number')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('cylinder_number') ? 'parsley-error ' : ''; @endphp
            <label for="cylinder_number" class="form-label">@lang('product.cylinder_number')</label>
            <div class="form-group">
                {{ Form::text('cylinder_number', null, ['class' => $error_class.'form-control', 'id' => 'cylinder_number', 'required' => false, 'pattern' => $en_bn_number_pattern]) }}
                @if ($errors->has('cylinder_number'))
                    <p class="text-danger">{{$errors->first('cylinder_number')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('weight') ? 'parsley-error ' : ''; @endphp
            <label for="weight" class="form-label">@lang('product.weight')</label>
            <div class="form-group">
                {{ Form::text('weight', null, ['class' => $error_class.'form-control', 'id' => 'weight', 'required' => false, 'pattern' => $en_bn_number_pattern]) }}
                @if ($errors->has('weight'))
                    <p class="text-danger">{{$errors->first('weight')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('volume') ? 'parsley-error ' : ''; @endphp
            <label for="volume" class="form-label">@lang('product.volume')</label>
            <div class="form-group">
                {{ Form::text('volume', null, ['class' => $error_class.'form-control', 'id' => 'volume', 'required' => false, 'pattern' => $en_bn_number_pattern]) }}
                @if ($errors->has('volume'))
                    <p class="text-danger">{{$errors->first('volume')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('horsepower') ? 'parsley-error ' : ''; @endphp
            <label for="horsepower" class="form-label">@lang('product.horsepower')</label>
            <div class="form-group">
                {{ Form::text('horsepower', null, ['class' => $error_class.'form-control', 'id' => 'horsepower', 'required' => false, 'pattern' => $en_bn_number_pattern]) }}
                @if ($errors->has('horsepower'))
                    <p class="text-danger">{{$errors->first('horsepower')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2" v-if="type && type != 'pump'">
            @php /** @var string $errors */
        $error_class = $errors->has('tire_size') ? 'parsley-error ' : ''; @endphp
            <label for="tire_size" class="form-label">@lang('product.tire_size')</label>
            <div class="form-group">
                {{ Form::text('tire_size', null, ['class' => $error_class.'form-control', 'id' => 'tire_size', 'required' => false]) }}
                @if ($errors->has('tire_size'))
                    <p class="text-danger">{{$errors->first('tire_size')}}</p>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-4 my-2" v-if="type && type != 'pump'">
            @php /** @var string $errors */
        $error_class = $errors->has('tire_number') ? 'parsley-error ' : ''; @endphp
            <label for="tire_number" class="form-label">@lang('product.tire_number')</label>
            <div class="form-group">
                {{ Form::text('tire_number', null, ['class' => $error_class.'form-control', 'id' => 'tire_number', 'required' => false, 'pattern' => $en_bn_number_pattern]) }}
                @if ($errors->has('tire_number'))
                    <p class="text-danger">{{$errors->first('tire_number')}}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-2 my-2">
            @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
            <label for="status" class="form-label">@lang('product.status')</label>
            <sup class="text-danger">*</sup>
            <div class="form-group form-group-check pl-4">
                <div class="form-check-custom">
                    {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                    <label class="form-check-label" for="active">
                        @lang('product.active')
                    </label>
                </div>

                <div class="form-check-custom">
                    {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                    <label class="form-check-label" for="inactive">
                        @lang('product.inactive')
                    </label>
                </div>
                @if ($errors->has('status'))
                    <p class="text-danger">{{$errors->first('status')}}</p>
                @endif
            </div>
        </div>
{{--
           TODO:: ongoing
        <hr>
        <h3>{{ 'গাড়ীর চালকসমূহ' }}</h3>

        <div class="row">
            <div class="col-md-12 text-left">
                <a class="btn btn-primary waves-effect waves-light modal_lg_button">
                    <i class="fa fa-plus-square"></i> @lang('common.create',['model' => trans('driver.driver')])
                </a>
            </div>
        </div>
--}}

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

    <div class="border border-secondary mb-4 p-3">
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

    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                <i class="fa fa-save"></i> @lang('product.submit')
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
                    preview_list: [],
                    image_list: [],
                    delete_images: [],
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
                    toggleType(){
                        this.type = event.currentTarget.value
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
                        this.type = '{!! @$product->type ?? '' !!}'

                        this.preview_list = {!! $product->files ?? '{}' !!}
                    },
                },
                mounted(){
                    $(document).trigger('vue-loaded');
                    $('#loader').hide()
                },
                created() {
                    window.vue_data = this;
                    @if(@$product)
                        this.load_parameters()
                    @endif
                },
                beforeUpdate(){
                    $(document).trigger('vue-loaded');
                },
            });

        });

        $(document).on('submit', '#product_form', function (event) {
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
            console.log(images);
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
                    window.location.href = '{{route('product.index')}}'
                },
                error: function (xhr) {
                    ajax_error_alert.removeClass('d-none');
                    if(xhr.status === 500 && xhr.responseJSON){
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

                            input_array.forEach(function (value) {
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
