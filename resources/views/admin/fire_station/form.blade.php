<div class="row mb-3">
    <div class="col-sm-6 col-md-4 col-lg-6 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('division_id') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('fire_station.division')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('division_id', $divisions, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('fire_station.select_one'), 'id' => 'division_id', 'onChange'=>'GetDistrict()', 'required' => 1]) }}
            @if ($errors->has('division_id'))
                <p class="text-danger">{{$errors->first('division_id')}}</p>
            @endif
        </div>
    </div>
    {{--<div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('greater_district_id') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('fire_station.greater_district')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('greater_district_id', $greater_districts, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('fire_station.select_one'), 'id' => 'greater_district_id', 'onChange'=>'GetDistrict()', 'required' => 1]) }}
            @if ($errors->has('greater_district_id'))
                <p class="text-danger">{{$errors->first('greater_district_id')}}</p>
            @endif
        </div>
    </div>--}}
    <div class="col-sm-6 col-md-4 col-lg-6 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('district_id') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('fire_station.district')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('district_id', $districts, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('fire_station.select_one'), 'id' => 'district_id', 'onChange'=>'GetThana()', 'required' => 1]) }}
            @if ($errors->has('district_id'))
                <p class="text-danger">{{$errors->first('district_id')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-6 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('thana_id') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('fire_station.thana')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{--{{ Form::select('thana_id[]', $thanas, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('fire_station.select_one'), 'id' => 'thana_id', 'required' => 1,'multiple'=>true]) }}--}}
            <select name="thana_id[]" id="thana_id" class="select2 form-control" data-placeholder="{{trans('fire_station.select_one')}}" multiple required>
                @foreach($thanas as $key => $value)
                    @php
                        if(in_array($key, explode(',', @$fire_station->thana_id))){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                    @endphp
                    <option value="{{$key}}" {{$selected}}>{{$value}}</option>
                @endforeach
            </select>
            @if ($errors->has('thana_id'))
                <p class="text-danger">{{$errors->first('thana_id')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-6 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('fire_station_type_id') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('fire_station.fire_station_type')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('fire_station_type_id', $fire_station_types, null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('fire_station.select_one'), 'id' => 'fire_station_type_id', 'required' => 1]) }}
            @if ($errors->has('fire_station_type_id'))
                <p class="text-danger">{{$errors->first('fire_station_type_id')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-6 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('category') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('fire_station.category')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('category', \App\Models\FireStation::getCategories(), null, ['class' => $error_class.'form-control select2', 'placeholder' => trans('fire_station.select_one'), 'id' => 'category', 'required' => 1]) }}
            @if ($errors->has('category'))
                <p class="text-danger">{{$errors->first('category')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('name') ? 'parsley-error ' : ''; @endphp
        <label for="name" class="form-label">@lang('fire_station.label_name')</label>
        <div class="form-group">
            {{ Form::text('name', null, ['class' => $error_class.'form-control', 'id' => 'name', 'required' => false]) }}
            @if ($errors->has('name'))
                <p class="text-danger">{{$errors->first('name')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('bn_name') ? 'parsley-error ' : ''; @endphp
        <label for="bn_name" class="form-label">@lang('fire_station.label_bn_name')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('bn_name', null, ['class' => $error_class.'form-control', 'id' => 'bn_name', 'required' => 1]) }}
            @if ($errors->has('bn_name'))
                <p class="text-danger">{{$errors->first('bn_name')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('address') ? 'parsley-error ' : ''; @endphp
        <label for="address" class="form-label">@lang('fire_station.label_address')</label>
        <div class="form-group">
            {{ Form::text('address', null, ['class' => $error_class.'form-control', 'id' => 'address', 'required' => false]) }}
            @if ($errors->has('address'))
                <p class="text-danger">{{$errors->first('address')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('phone') ? 'parsley-error ' : ''; @endphp
        <label for="phone" class="form-label">@lang('fire_station.label_phone')</label>
        <div class="form-group">
            {{ Form::text('phone', null, ['class' => $error_class.'form-control', 'id' => 'phone', 'required' => false]) }}
            @if ($errors->has('phone'))
                <p class="text-danger">{{$errors->first('phone')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('mobile') ? 'parsley-error ' : ''; @endphp
        <label for="mobile" class="form-label">@lang('fire_station.label_mobile')</label>
        <div class="form-group">
            {{ Form::text('mobile', null, ['class' => $error_class.'form-control', 'id' => 'mobile', 'required' => false]) }}
            @if ($errors->has('mobile'))
                <p class="text-danger">{{$errors->first('mobile')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('email') ? 'parsley-error ' : ''; @endphp
        <label for="email" class="form-label">@lang('fire_station.label_email')</label>
        <div class="form-group">
            {{ Form::text('email', null, ['class' => $error_class.'form-control', 'id' => 'email', 'required' => false]) }}
            @if ($errors->has('email'))
                <p class="text-danger">{{$errors->first('email')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('code') ? 'parsley-error ' : ''; @endphp
        <label for="code" class="form-label">@lang('fire_station.label_code')</label>
        <div class="form-group">
            {{ Form::text('code', null, ['class' => $error_class.'form-control', 'id' => 'code', 'required' => false]) }}
            @if ($errors->has('code'))
                <p class="text-danger">{{$errors->first('code')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('fire_station.label_status')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('fire_station.label_status_active')
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('fire_station.label_status_inactive')
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
            <i class="fa fa-save"></i> @lang('fire_station.label_submit_button')
        </button>
    </div>
</div>

@section('script')
    <script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>

    @include('components.get_common_data')

@endsection
