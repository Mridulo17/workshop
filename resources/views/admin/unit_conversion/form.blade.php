<div class="row mb-3">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('name') ? 'parsley-error ' : ''; @endphp
        <label for="name" class="form-label">@lang('common.name',['model' => trans('unit_conversion.unit_conversion')])</label>
        <div class="form-group">
            {{ Form::text('name', null, ['class' => $error_class.'form-control', 'id' => 'name', 'required' => false]) }}
            @if ($errors->has('name'))
                <p class="text-danger">{{$errors->first('name')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('bn_name') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('common.bn_name',['model' => trans('unit_conversion.unit_conversion')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('bn_name', null, ['class' => $error_class.'form-control', 'id' => 'bn_name', 'required' => 1]) }}
            @if ($errors->has('bn_name'))
                <p class="text-danger">{{$errors->first('bn_name')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('unit_id') ? 'parsley-error ' : ''; @endphp
        <label for="unit_id" class="form-label">@lang('unit.unit')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('unit_id', $units, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'unit_id', 'required' => 1]) }}
            @if ($errors->has('unit_id'))
                <p class="text-danger">{{$errors->first('unit_id')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('product_part_id') ? 'parsley-error ' : ''; @endphp
        <label for="product_part_id" class="form-label">@lang('product_part.product_part')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('product_part_id', $product_parts, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'product_part_id', 'required' => 1]) }}
            @if ($errors->has('product_part_id'))
                <p class="text-danger">{{$errors->first('product_part_id')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('conversion_rate') ? 'parsley-error ' : ''; @endphp
        <label for="conversion_rate" class="form-label">@lang('unit_conversion.conversion_rate')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('conversion_rate', null, ['class' => $error_class.'form-control bn_language_vue', 'id' => 'conversion_rate', 'required' => 1, /*'pattern' => $bn_number_pattern*/]) }}
            @if ($errors->has('conversion_rate'))
                <p class="text-danger">{{$errors->first('conversion_rate')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('unit_conversion.unit_conversion')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('unit_conversion.unit_conversion')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('unit_conversion.unit_conversion')])
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
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('unit_conversion.unit_conversion')])
        </button>
    </div>
</div>

@if(!request()->ajax()) @section('script') @endif
<script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>

<script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>
@if(!request()->ajax()) @endsection @endif
