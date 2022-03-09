<style>
    .form-label {
        margin-bottom: -0.5rem;
        /* font-size: 10px;
        font-weight: bold; */
    }
</style>
<div id="vue" class="row mb-3">
    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
        <label for="type_id" class="form-label">@lang('type.type')</label>
        <div class="form-group">
            {{ Form::select('type_id', $types, null, ['class' => $error_class.'form-control select2vue type_id', 'placeholder' => trans('common.select'), 'id' => 'type_id', 'required' => false, 'onchange' => 'SelectChange("'.route('get_categories_by_type').'","category_id",this)']) }}
            @if ($errors->has('type_id'))
                <p class="text-danger">{{$errors->first('type_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
        <label for="category_id" class="form-label">@lang('category.category')</label>
        <div class="form-group">
            {{ Form::select('category_id', $categories, null, ['class' => $error_class.'form-control select2vue category_id', 'placeholder' => trans('common.select'), 'id' => 'category_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","product_id",this,"model_id")']) }}
            @if ($errors->has('category_id'))
                <p class="text-danger">{{$errors->first('category_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('brand_id') ? 'parsley-error ' : ''; @endphp
        <label for="brand_id" class="form-label">@lang('brand.brand')</label>
        <div class="form-group">
            {{ Form::select('brand_id', $brands, null, ['class' => $error_class.'form-control select2vue brand_id', 'placeholder' => trans('common.select'), 'id' => 'brand_id', 'required' => false, 'onchange' => 'SelectChange("'.route('get_models').'","model_id",this)']) }}
            @if ($errors->has('brand_id'))
                <p class="text-danger">{{$errors->first('brand_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('model_id') ? 'parsley-error ' : ''; @endphp
        <label for="model_id" class="form-label">@lang('model.model')</label>
        <div class="form-group">
            {{ Form::select('model_id', $models, null, ['class' => $error_class.'form-control select2vue model_id', 'placeholder' => trans('common.select'), 'id' => 'model_id', 'required' => false, 'onchange' => 'SelectChangeDependent("'.route('get_products').'","product_id",this,"category_id")']) }}
            @if ($errors->has('model_id'))
                <p class="text-danger">{{$errors->first('model_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('product_id') ? 'parsley-error ' : ''; @endphp
        <label for="product_id" class="form-label">@lang('product.product')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group text-uppercase">
            {{ Form::select('product_id', $products, null, ['class' => $error_class.'form-control select2vue product_id', 'placeholder' => trans('common.select'), 'id' => 'product_id', 'required' => false]) }}
            @if ($errors->has('product_id'))
                <p class="text-danger">{{$errors->first('product_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('registration_number') ? 'parsley-error ' : ''; @endphp
        <label for="registration_number" class="form-label">@lang('inspection_report.registration_divisional_number')
        </label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::select('registration_number', $product_registration_numbers, @$product_id, ['class' =>
            $error_class.'form-control select2vue registration_number', 'placeholder' =>
            trans('common.select'), 'id' => 'registration_number', 'required' =>
            false]) }}
            @if ($errors->has('registration_number'))
                <p class="text-danger">{{$errors->first('registration_number')}}</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <hr>
        <h6 class="font-weight-semibold">@lang('tyre_record.tyre_records')</h6>
        <div v-for="(row,index) in tyre_record_inputs">
            <div  class="border border-secondary mb-6 p-3 my-2">
                <div class="col-sm-12">
                    <h5>
                        <span v-if="index != 0" lang="{{App::getLocale() == 'bn' ? 'bang' : ''}}" class="badge bg-success float-start">@{{ index+1 }}</span>
                    </h5>
                </div>
                <div class="col-sm-12 text-right">
                    <button v-if="index != 0" type="button" class="btn btn-danger btn-sm" @click="removeTyreRecordDetail(index)"><i class="fas fa-times text-warning"></i> </button>
                </div>
                <div class="row" >
                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('issue_date') ? 'parsley-error ' : ''; @endphp
                        <label for="issue_date" class="form-label">@lang('tyre_record.issue_date',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy" v-model="row.issue_date" class="{{$error_class}} form-control" type="text"
                                   :name="'tyre_record_details['+index+'][issue_date]'" id="issue_date">
                            @if ($errors->has('issue_date'))
                                <p class="text-danger">{{$errors->first('issue_date')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('tyre_serial_number') ? 'parsley-error ' : ''; @endphp
                        <label for="tyre_serial_number" class="form-label">@lang('tyre_record.tyre_serial_number',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input v-model="row.tyre_serial_number" class="{{$error_class}} form-control"
                                   :name="'tyre_record_details['+index+'][tyre_serial_number]'">
                            @if ($errors->has('tyre_serial_number'))
                                <p class="text-danger">{{$errors->first('tyre_serial_number')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('tyre_number') ? 'parsley-error ' : ''; @endphp
                        <label for="tyre_number" class="form-label">@lang('tyre_record.tyre_number',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input v-model="row.tyre_number" class="{{$error_class}} form-control"
                                   :name="'tyre_record_details['+index+'][tyre_number]'">
                            @if ($errors->has('tyre_number'))
                                <p class="text-danger">{{$errors->first('tyre_number')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('tyre_size') ? 'parsley-error ' : ''; @endphp
                        <label for="tyre_size" class="form-label mt-2">@lang('tyre_record.tyre_size',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input v-model="row.tyre_size" class="{{$error_class}} form-control"
                                   :name="'tyre_record_details['+index+'][tyre_size]'">
                            @if ($errors->has('tyre_size'))
                                <p class="text-danger">{{$errors->first('tyre_size')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('tyre_ply') ? 'parsley-error ' : ''; @endphp
                        <label for="tyre_ply" class="form-label mt-2">@lang('tyre_record.tyre_ply',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input v-model="row.tyre_ply" class="{{$error_class}} form-control"
                                   :name="'tyre_record_details['+index+'][tyre_ply]'">
                            @if ($errors->has('tyre_ply'))
                                <p class="text-danger">{{$errors->first('tyre_ply')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('manufacturer_brand_id') ? 'parsley-error ' : ''; @endphp
                        <label for="manufacturer_brand_id" class="form-label mt-2">@lang('tyre_record.manufacturer_brand_id',['model' => trans('tyre_record.tyre_record')])</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <select v-model="row.manufacturer_brand_id" :name="'tyre_record_details['+index+'][manufacturer_brand_id]'" class="{{$error_class}} form-control">
                                @foreach($brands as $key => $brand)
                                    <option value="{{$key}}">{{$brand}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('manufacturer_brand_id'))
                                <p class="text-danger">{{$errors->first('manufacturer_brand_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('manufacturer_country_id') ? 'parsley-error ' : ''; @endphp
                        <label for="manufacturer_country_id" class="form-label mt-2">@lang('tyre_record.manufacturer_country_id',['model' => trans('tyre_record.tyre_record')])</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <select v-model="row.manufacturer_country_id" :name="'tyre_record_details['+index+'][manufacturer_country_id]'" class="{{$error_class}} form-control">
                                @foreach($countries as $key => $country)
                                    <option value="{{$country->id}}">{{$country->bn_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('manufacturer_country_id'))
                                <p class="text-danger">{{$errors->first('manufacturer_country_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('rotation_date') ? 'parsley-error ' : ''; @endphp
                        <label for="rotation_date" class="form-label mt-2">@lang('tyre_record.rotation_date',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy" v-model="row.rotation_date" class="{{$error_class}} form-control" type="text"
                                   :name="'tyre_record_details['+index+'][rotation_date]'" id="rotation_date">
                            @if ($errors->has('rotation_date'))
                                <p class="text-danger">{{$errors->first('rotation_date')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('rotation_meter_reading') ? 'parsley-error ' : ''; @endphp
                        <label for="rotation_meter_reading" class="form-label mt-2">@lang('tyre_record.rotation_meter_reading',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input v-model="row.rotation_meter_reading" class="{{$error_class}} form-control"
                                   :name="'tyre_record_details['+index+'][rotation_meter_reading]'">
                            @if ($errors->has('rotation_meter_reading'))
                                <p class="text-danger">{{$errors->first('rotation_meter_reading')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('rejected_announced_date') ? 'parsley-error ' : ''; @endphp
                        <label for="rejected_announced_date" class="form-label mt-2">@lang('tyre_record.rejected_announced_date',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input pattern="/^(0[1-9]|1\d|2\d|3[01])\-(0[1-9]|1[0-2])\-(1|2)\d{3}$/" placeholder="dd-mm-yyyy" v-model="row.rejected_announced_date" class="{{$error_class}} form-control" type="text"
                                   :name="'tyre_record_details['+index+'][rejected_announced_date]'" id="rejected_announced_date">
                            @if ($errors->has('rejected_announced_date'))
                                <p class="text-danger">{{$errors->first('rejected_announced_date')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('rejected_announce_meter_reading') ? 'parsley-error ' : ''; @endphp
                        <label for="rejected_announce_meter_reading" class="form-label mt-2">@lang('tyre_record.rejected_announce_meter_reading',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input v-model="row.rejected_announce_meter_reading" class="{{$error_class}} form-control"
                                   :name="'tyre_record_details['+index+'][rejected_announce_meter_reading]'" id="rejected_announce_meter_reading">
                            @if ($errors->has('rejected_announce_meter_reading'))
                                <p class="text-danger">{{$errors->first('rejected_announce_meter_reading')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('rejected_announce_tyre_number') ? 'parsley-error ' : ''; @endphp
                        <label for="rejected_announce_tyre_number" class="form-label mt-2">@lang('tyre_record.rejected_announce_tyre_number',['model' => trans('tyre_record.tyre_record')])</label>
                        <div class="form-group">
                            <input v-model="row.rejected_announce_tyre_number" class="{{$error_class}} form-control"
                                   :name="'tyre_record_details['+index+'][rejected_announce_tyre_number]'" id="rejected_announce_tyre_number">
                            @if ($errors->has('rejected_announce_tyre_number'))
                                <p class="text-danger">{{$errors->first('rejected_announce_tyre_number')}}</p>
                            @endif
                        </div>
                    </div>
                    {{-- driver_employees --}}
                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('driver_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="driver_employee_id" class="form-label mt-2">@lang('tyre_record.driver_employee_id',['model' => trans('tyre_record.tyre_record')])</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <select v-model="row.driver_employee_id" :name="'tyre_record_details['+index+'][driver_employee_id]'" class="{{$error_class}} form-control">
                                @foreach($driver_employees as $key => $driver_employee)
                                    <option value="{{$driver_employee->id}}">{{$driver_employee->bn_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('driver_employee_id'))
                                <p class="text-danger">{{$errors->first('driver_employee_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        @php $error_class = $errors->has('sso_so_employee_id') ? 'parsley-error ' : ''; @endphp
                        <label for="sso_so_employee_id" class="form-label mt-2">@lang('tyre_record.sso_so_employee_id',['model' => trans('tyre_record.tyre_record')])</label>
                        <sup class="text-danger">*</sup>
                        <div class="form-group">
                            <select v-model="row.sso_so_employee_id" :name="'tyre_record_details['+index+'][sso_so_employee_id]'" class="{{$error_class}} form-control">
                                @foreach($sso_so_employees as $key => $sso_so_employee)
                                    <option value="{{$sso_so_employee->id}}">{{$sso_so_employee->bn_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('sso_so_employee_id'))
                                <p class="text-danger">{{$errors->first('sso_so_employee_id')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-right">
            <a href="javascript:" class="btn btn-success"  @click="addMoreTyreRecordDetail">
                <i class="fa fa-plus-circle"></i>
                @lang('tyre_record.add_tyre_record')
            </a>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
        <label for="status" class="form-label">@lang('common.status',['model' => trans('tyre_record.tyre_record')])</label>
        <sup class="text-danger">*</sup>
        <div class="form-group form-group-check pl-4">
            <div class="form-check-custom">
                {{ Form::radio('status', 'Active',null, ['class' => 'form-check-input', 'id' => 'active', 'required' => 1, 'checked' => 1]) }}
                <label class="form-check-label" for="active">
                    @lang('common.active',['model' => trans('tyre_record.tyre_record')])
                </label>
            </div>

            <div class="form-check-custom">
                {{ Form::radio('status', 'Inactive',null, ['class' => 'form-check-input', 'id' => 'inactive', 'required' => 1]) }}
                <label class="form-check-label" for="inactive">
                    @lang('common.inactive',['model' => trans('tyre_record.tyre_record')])
                </label>
            </div>
            @if ($errors->has('status'))
                <p class="text-danger">{{$errors->first('status')}}</p>
            @endif
        </div>
    </div>
</div>
{{--<div class="row">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('examinor_signature') ? 'parsley-error ' : ''; @endphp
        <label for="examinor_signature" class="form-label">@lang('tyre_record.examinor_signature')</label>
        <div class="form-group">
            {{ Form::file('examinor_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'examinor_signature', 'onchange' => "preview_examinor_signature(this)",  'accept' => "examinor_signature/*"]) }}
            @if ($errors->has('examinor_signature'))
                <p class="text-danger">{{$errors->first('examinor_signature')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        <label class="col-form-label" for="examinor_signature">@lang('tyre_record.examinor_signature_preview')</label><br>
        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="examinor_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">
    </div>

    @if(Request::segment(4) == 'edit')
        <div class="col-sm-12 col-md-4 my-2">
            <label class="col-form-label">
                @lang('tyre_record.examinor_signature_existing')
                {{ Form::checkbox('remove_examinor_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_examinor_signature']) }}
                <label for="remove_examinor_signature" class="form-label">@lang('tyre_record.remove_examinor_signature')</label>
            </label><br>
            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($tyre_record->examinor_signature->source ?? '')}}" alt="@lang('tyre_record.examinor_signature_existing')">
        </div>
    @endif
</div>
<div class="row">
    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('driver_signature') ? 'parsley-error ' : ''; @endphp
        <label for="driver_signature" class="form-label">@lang('tyre_record.driver_signature')</label>
        <div class="form-group">
            {{ Form::file('driver_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'driver_signature', 'onchange' => "preview_driver_signature(this)",  'accept' => "driver_signature/*"]) }}
            @if ($errors->has('driver_signature'))
                <p class="text-danger">{{$errors->first('driver_signature')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        <label class="col-form-label" for="driver_signature">@lang('tyre_record.driver_signature_preview')</label><br>
        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="driver_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">
    </div>

    @if(Request::segment(4) == 'edit')
        <div class="col-sm-12 col-md-4 my-2">
            <label class="col-form-label">
                @lang('tyre_record.driver_signature_existing')
                {{ Form::checkbox('remove_driver_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_driver_signature']) }}
                <label for="remove_driver_signature" class="form-label">@lang('tyre_record.remove_driver_signature')</label>
            </label><br>
            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($tyre_record->driver_signature->source ?? '')}}" alt="@lang('tyre_record.driver_signature_existing')">
        </div>
    @endif
</div>--}}
{{--<div class="row">--}}
{{--    <div class="col-sm-12 col-md-4 my-2">--}}
{{--        @php /** @var string $errors */--}}
{{--            $error_class = $errors->has('sso_so_signature') ? 'parsley-error ' : ''; @endphp--}}
{{--        <label for="sso_so_signature" class="form-label">@lang('tyre_record.sso_so_signature')</label>--}}
{{--        <div class="form-group">--}}
{{--            {{ Form::file('sso_so_signature', ['class' => $error_class.'form-control', 'required' => false, 'id' => 'sso_so_signature', 'onchange' => "preview_sso_so_signature(this)",  'accept' => "sso_so_signature/*"]) }}--}}
{{--            @if ($errors->has('sso_so_signature'))--}}
{{--                <p class="text-danger">{{$errors->first('sso_so_signature')}}</p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="col-sm-12 col-md-4 my-2">--}}
{{--        <label class="col-form-label" for="sso_so_signature">@lang('tyre_record.sso_so_signature_preview')</label><br>--}}
{{--        <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" id="sso_so_signature_preview" src="{{asset('assets/common/images/signature.png')}}" alt="Image Preview">--}}
{{--    </div>--}}

{{--    @if(Request::segment(4) == 'edit')--}}
{{--        <div class="col-sm-12 col-md-4 my-2">--}}
{{--            <label class="col-form-label">--}}
{{--                @lang('tyre_record.sso_so_signature_existing')--}}
{{--                {{ Form::checkbox('remove_sso_so_signature', null, null, ['class' => 'form-check-input', 'id' => 'remove_sso_so_signature']) }}--}}
{{--                <label for="remove_sso_so_signature" class="form-label">@lang('tyre_record.remove_sso_so_signature')</label>--}}
{{--            </label><br>--}}
{{--            <img class="img-fluid" style="border: 2px solid #adb5bd;margin: 0 auto; padding: 2px; border-radius: 2%;" src="{{asset($tyre_record->sso_so_signature->source ?? '')}}" alt="@lang('tyre_record.sso_so_signature_existing')">--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</div>--}}

<div class="row">
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> @lang('common.submit',['model' => trans('tyre_record.tyre_record')])
        </button>
    </div>
</div>

@if(!request()->ajax()) @section('script') @endif
<script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>

<script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
<script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>

<script>
    /*//profile_picture preview
    function preview_examinor_signature(input){
        let file = $("#examinor_signature").get(0).files[0];

        if(file){
            let reader = new FileReader();

            reader.onload = function(){
                $("#examinor_signature_preview").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }

    //profile_picture preview
    function preview_examinor_signature(input){
        let file = $("#examinor_signature").get(0).files[0];

        if(file){
            let reader = new FileReader();

            reader.onload = function(){
                $("#examinor_signature_preview").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }*/

    $(function () {
        let vue = new Vue({
            el: '#vue',
            data: {
                tyre_record_inputs: [{
                    issue_date:'',
                    tyre_serial_number:'',
                    tyre_number:'',
                    tyre_size:'',
                    tyre_ply:'',
                    manufacturer_brand_id:'',
                    manufacturer_country_id:'',
                    rotation_date:'',
                    rotation_meter_reading:'',
                    rejected_announced_date:'',
                    rejected_announce_meter_reading:'',
                    rejected_announce_tyre_number:'',
                    driver_employee_id:'',
                    sso_so_employee_id:'',
                }],
            },
            methods: {
                addMoreTyreRecordDetail(){
                    this.tyre_record_inputs.push({
                        issue_date:'',
                        tyre_serial_number:'',
                        tyre_number:'',
                        tyre_size:'',
                        tyre_ply:'',
                        manufacturer_brand_id:'',
                        manufacturer_country_id:'',
                        rotation_date:'',
                        rotation_meter_reading:'',
                        rejected_announced_date:'',
                        rejected_announce_meter_reading:'',
                        rejected_announce_tyre_number:'',
                        driver_employee_id:'',
                        sso_so_employee_id:'',
                    });
                },
                removeTyreRecordDetail(index) {
                    this.tyre_record_inputs.splice(index, 1);
                },
                load_parameters(){
                    console.log({!! @$tyre_record->tyreRecordDetails !!})
                    this.tyre_record_inputs = {!! @$tyre_record->tyreRecordDetails ?? '{}' !!}
                },
            },
            created() {
                @if(\Route::currentRouteName() == 'tyre_record.edit')
                    this.load_parameters()
                @endif
            },
            mounted() {
                $(document).trigger('vue-loaded');
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
                    console.log(response)
                    $('#type_id').val(response.type_id)
                    $('#category_id').val(response.category_id)
                    $('#brand_id').val(response.brand_id)
                    $('#model_id').val(response.model_id)

                    $('#registration_number').val(response.id)
                    $('.select2vue').select2()

                    // $('#divisional_number').val(response.divisional_number)
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
                    $('#type_id').val(response.type_id)
                    $('#category_id').val(response.category_id)
                    $('#brand_id').val(response.brand_id)
                    $('#model_id').val(response.model_id)


                    $('#product_id').val(response.id)
                    $('.select2vue').select2()

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
    })

    // ajax form submit
    $(document).on('submit', '.tyre_record_submit', function (event) {
        $('#loader').show();
        event.preventDefault();
        let data = $(this).serialize();
        console.log('Hello from ajax submit');

        /*------Remove previous validation messages------*/
        $('input').next().remove('.ajax-error');
        $('select').next().remove('.ajax-error');
        $('textarea').next().remove('.ajax-error');


        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            data: data,

            success: function (response) {
                console.log(response)
                /*------Success redirects to show page------*/
                window.location.href = response.url;
            },
            error: function (xhr, status, exception) {
                setTimeout(function(){
                    $('#loader').hide();
                }, 280);
                console.log(xhr.responseJSON)

                if (exception === 'Bad Request'){
                    console.log(xhr.responseJSON.errors)

                    toastr.error("Something Wrong! Try Again Please!", {
                        closeButton: true,
                        progressBar: true,
                    });

                } else {
                    var errors = Object.entries(xhr.responseJSON.errors);
                    console.log(errors)

                    /*------Validation Messages------*/
                    for(const [index, error] of errors.entries()){

                        if (error[0].includes('tyre_record_details.')){
                            const splited = error[0].split(".");

                            if (splited.length > 1){

                                const error_formatted = '\''+splited[0]+'['+parseInt(splited[1])+']['+splited[2]+']'+'\'';

                                if (index === 0){
                                    $('html, body').animate({
                                        scrollTop: $('input[name='+error_formatted+'], select[name='+error_formatted+'], textarea[name='+error_formatted+']').offset().top - 200
                                    }, 500);
                                }

                                const input2 = $('input[name=' + error_formatted + ']');
                                input2.addClass('is-invalid')
                                input2.after(
                                    '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                                );

                                const select2 = $('select[name=' + error_formatted + ']');
                                select2.addClass('is-invalid')
                                select2.after(
                                    '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                                );

                                const textarea2 = $('textarea[name=' + error_formatted + ']');
                                textarea2.addClass('is-invalid')
                                textarea2.after(
                                    '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                                );

                                toastr.error(error[1], {
                                    closeButton: true,
                                    progressBar: true,
                                });

                            }
                        } else {

                            if (index === 0){
                                $('html, body').animate({
                                    scrollTop: $('input[name='+error[0]+'], select[name='+error[0]+'], textarea[name='+error[0]+']').offset().top - 200
                                }, 500);
                            }

                            const input = $('input[name='+error[0]+']');
                            input.addClass('is-invalid')
                            input.after(
                                '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                            );

                            const select = $('select[name='+error[0]+']');
                            select.addClass('is-invalid')
                            select.after(
                                '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                            );

                            const textarea = $('textarea[name='+error[0]+']');
                            textarea.addClass('is-invalid')
                            textarea.after(
                                '<p class="text-danger ajax-error"><strong>'+error[1]+'</strong></p>'
                            );

                            toastr.error(error[1], {
                                closeButton: true,
                                progressBar: true,
                            });
                        }
                    }
                }
            }
        });
    });
</script>

@include('admin.layouts.partial.footer.vue_loaded_script')

@if(!request()->ajax()) @endsection @endif
