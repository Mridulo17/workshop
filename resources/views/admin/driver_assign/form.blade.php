<div class="row mb-3">

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('driver_id') ? 'parsley-error ' : ''; @endphp
        <label for="driver_id" class="form-label">@lang('common.model',['model' => trans('driver.driver')])
            <sup class="text-danger">*</sup>
        </label>
        <div class="form-group">
            {{ Form::select('driver_id', $drivers, null, ['class' => $error_class.'form-control select2', 'id' => 'driver_id', 'placeholder' => trans('common.select'), 'required' => 1, 'autofocus']) }}
            @if ($errors->has('driver_id'))
                <p class="text-danger">{{$errors->first('driver_id')}}</p>
            @endif
        </div>
        @if(@$driver_inactive_warning)<span class="text-danger"> {{ $driver_inactive_warning }} </span>@endif
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('product_id') ? 'parsley-error ' : ''; @endphp
        <label for="product_id" class="form-label">@lang('driver_assign.vehicle')
            <sup class="text-danger">*</sup>
        </label>
        <div class="form-group">
            {{ Form::select('product_id', $products, null, ['class' => $error_class.'form-control select2', 'id' => 'product_id', 'placeholder' => trans('common.select'), 'required' => 1, 'onchange' => 'getVehicleDetails(this)']) }}
            @if ($errors->has('product_id'))
                <p class="text-danger">{{$errors->first('product_id')}}</p>
            @endif
        </div>
        @if(@$product_inactive_warning)<span class="text-danger"> {{ $product_inactive_warning }} </span>@endif
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('registration_number') ? 'parsley-error ' : ''; @endphp
        <label for="registration_number" class="form-label">@lang('workshop_order.registration_number')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('registration_number', @$product->registration_number, ['class' => $error_class.'form-control', 'id' => 'registration_number', 'readonly', 'required' => 1]) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
        <label for="type_id" class="form-label">@lang('common.model',['model' => trans('type.type')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('type_id', @$product->type->bn_name, ['class' => $error_class.'form-control', 'id' => 'type_id', 'readonly', 'required' => 1]) }}
            @if ($errors->has('type_id'))
                <p class="text-danger">{{$errors->first('type_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
        <label for="category_id" class="form-label">@lang('common.model',['model' => trans('category.category')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('category_id', @$product->category->bn_name, ['class' => $error_class.'form-control', 'id' => 'category_id', 'readonly', 'required' => 1]) }}
            @if ($errors->has('category_id'))
                <p class="text-danger">{{$errors->first('category_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('brand_id') ? 'parsley-error ' : ''; @endphp
        <label for="brand_id" class="form-label">@lang('common.model',['model' => trans('brand.brand')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('brand_id', @$product->brand->bn_name, ['class' => $error_class.'form-control', 'id' => 'brand_id', 'readonly', 'required' => 1]) }}
            @if ($errors->has('brand_id'))
                <p class="text-danger">{{$errors->first('brand_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('model_id') ? 'parsley-error ' : ''; @endphp
        <label for="model_id" class="form-label">@lang('common.model',['model' => trans('model.model')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('model_id', @$product->model->bn_name, ['class' => $error_class.'form-control', 'id' => 'model_id', 'readonly', 'required' => 1]) }}
            @if ($errors->has('model_id'))
                <p class="text-danger">{{$errors->first('model_id')}}</p>
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
<div class="row">
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit')
        </button>
    </div>
</div>

@if(!request()->ajax()) @section('script') @endif
    <script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>

    <script>
        function getVehicleDetails(object) {
            if (object.value){
                $.ajax({
                    url: '{{ route('find_product') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    cache: false,
                    data:{
                        id: object.value
                    },
                    success: function (response) {
                        registration_number = response.registration_number ?? ''
                        type = response.type.bn_name ?? ''
                        category = response.category.bn_name ?? ''
                        brand = response.brand.bn_name ?? ''
                        model = response.model.bn_name ?? ''
                        $('#registration_number').val(registration_number);
                        $('#type_id').val(type);
                        $('#category_id').val(category);
                        $('#brand_id').val(brand);
                        $('#model_id').val(model);
                    },
                    error: function (xhr) {

                    }
                });
            }
        }

        $(function() {
            if ($('#product_id').val()){
                getVehicleDetails($('#product_id'))
            }
        });
    </script>
@if(!request()->ajax()) @endsection @endif
