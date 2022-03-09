<div class="row mb-3">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('name') ? 'parsley-error ' : ''; @endphp
        <label for="name" class="form-label">@lang('common.name',['model' => trans('supplier.supplier')])</label>
        <div class="form-group">
            {{ Form::text('name', null, ['class' => $error_class.'form-control', 'required' => false]) }}
            @if ($errors->has('name'))
                <p class="text-danger">{{$errors->first('name')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('bn_name') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('common.bn_name',['model' => trans('supplier.supplier')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('bn_name', null, ['class' => $error_class.'form-control', 'required' => 1]) }}
            @if ($errors->has('bn_name'))
                <p class="text-danger">{{$errors->first('bn_name')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('mobile') ? 'parsley-error ' : ''; @endphp
        <label for="mobile" class="form-label">@lang('supplier.mobile')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('mobile', null, ['class' => $error_class.'form-control', 'required' => 1]) }}
            @if ($errors->has('mobile'))
                <p class="text-danger">{{$errors->first('mobile')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('alter_mobile') ? 'parsley-error ' : ''; @endphp
        <label for="alter_mobile" class="form-label">@lang('supplier.alter_mobile')</label>
        <div class="form-group">
            {{ Form::text('alter_mobile', null, ['class' => $error_class.'form-control', 'required' => false]) }}
            @if ($errors->has('alter_mobile'))
                <p class="text-danger">{{$errors->first('alter_mobile')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('email') ? 'parsley-error ' : ''; @endphp
        <label for="email" class="form-label">@lang('supplier.email')</label>
        <div class="form-group">
            {{ Form::text('email', null, ['class' => $error_class.'form-control', 'required' => false]) }}
            @if ($errors->has('email'))
                <p class="text-danger">{{$errors->first('email')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('division_id') ? 'parsley-error ' : ''; @endphp
        <label for="division_id" class="form-label">@lang('supplier.division')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('division_id', @$divisions, @$division_id ? $division_id : null, ['class' => $error_class.'form-control select2 division_id', 'placeholder' => trans('common.select'), 'onchange' => 'SelectChange("'.route('get_districts').'","district_id",this)', 'required' => false, @$division_id ? 'disabled' : '']) }}
            @if ($errors->has('division_id'))
                <p class="text-danger">{{$errors->first('division_id')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('district_id') ? 'parsley-error ' : ''; @endphp
        <label for="district_id" class="form-label">@lang('supplier.district')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('district_id', @$districts, @$district_id ? $district_id : null, ['class' => $error_class.'form-control select2 district_id', 'placeholder' => trans('common.select'), 'onchange' => 'SelectChange("'.route('get_thanas').'","thana_id",this)', 'required' => false, @$district_id ? 'disabled' : '']) }}
            @if ($errors->has('district_id'))
                <p class="text-danger">{{$errors->first('district_id')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('thana_id') ? 'parsley-error ' : ''; @endphp
        <label for="thana_id" class="form-label">@lang('supplier.thana')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('thana_id', @$thanas, @$thana_id ? $thana_id : null, ['class' => $error_class.'form-control select2 thana_id', 'placeholder' => trans('common.select'), 'required' => false, @$thana_id ? 'disabled' : '']) }}
            @if ($errors->has('thana_id'))
                <p class="text-danger">{{$errors->first('thana_id')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('area') ? 'parsley-error ' : ''; @endphp
        <label for="area" class="form-label">@lang('supplier.area')</label>
        <div class="form-group">
            {{ Form::text('area', null, ['class' => $error_class.'form-control', 'id' => 'area', 'required' => false]) }}
            @if ($errors->has('area'))
                <p class="text-danger">{{$errors->first('area')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('address') ? 'parsley-error ' : ''; @endphp
        <label for="address" class="form-label">@lang('supplier.address')</label>
        <div class="form-group">
            {{ Form::text('address', null, ['class' => $error_class.'form-control', 'id' => 'address', 'required' => false]) }}
            @if ($errors->has('address'))
                <p class="text-danger">{{$errors->first('address')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('contact_person') ? 'parsley-error ' : ''; @endphp
        <label for="contact_person" class="form-label">@lang('supplier.contact_person')</label>
        <div class="form-group">
            {{ Form::text('contact_person', null, ['class' => $error_class.'form-control', 'required' => false]) }}
            @if ($errors->has('contact_person'))
                <p class="text-danger">{{$errors->first('contact_person')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('contact_person_mobile') ? 'parsley-error ' : ''; @endphp
        <label for="contact_person_mobile" class="form-label">@lang('supplier.contact_person_mobile')</label>
        <div class="form-group">
            {{ Form::text('contact_person_mobile', null, ['class' => $error_class.'form-control', 'required' => false]) }}
            @if ($errors->has('contact_person_mobile'))
                <p class="text-danger">{{$errors->first('contact_person_mobile')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('supplier.supplier')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('supplier.supplier')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('supplier.supplier')])
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
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('supplier.supplier')])
        </button>
    </div>
</div>

@if(!request()->ajax()) @section('script') @endif
<script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>

<script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>
@if(!request()->ajax()) @endsection @endif
