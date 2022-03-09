<div class="row mb-3">

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('employee_id') ? 'parsley-error ' : ''; @endphp
        <label for="employee_id" class="form-label">@lang('common.model',['model' => trans('employee.employee')])
            <sup class="text-danger">*</sup>
        </label>
        <div class="form-group">
            {{ Form::select('employee_id', $employees, null, ['class' => $error_class.'form-control select2', 'id' => 'employee_id', 'placeholder' => trans('common.select'), 'required' => 1, 'autofocus', 'onchange' => 'getPin(this)']) }}
            @if ($errors->has('employee_id'))
                <p class="text-danger">{{$errors->first('employee_id')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('old_pin') ? 'parsley-error ' : ''; @endphp
        <label for="old_pin" class="form-label">@lang('driver.employee_old_pin')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('old_pin', @$model->employee->old_pin, ['class' => $error_class.'form-control', 'id' => 'old_pin', 'required' => 1, 'onkeyup' => 'getEmployeeFromPin(this)', 'onchange' => 'getEmployeeFromPin(this)']) }}
            @if ($errors->has('old_pin'))
                <p class="text-danger">{{$errors->first('old_pin')}}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php /** @var string $errors */
            $error_class = $errors->has('new_pin') ? 'parsley-error ' : ''; @endphp
        <label for="new_pin" class="form-label">@lang('driver.employee_new_pin')</label>
        <sup class="text-danger">*</sup>
        <div class="form-group">
            {{ Form::text('new_pin', @$model->employee->new_pin, ['class' => $error_class.'form-control', 'id' => 'new_pin', 'required' => 1, 'onkeyup' => 'getEmployeeFromPin(this)', 'onchange' => 'getEmployeeFromPin(this)']) }}
            @if ($errors->has('new_pin'))
                <p class="text-danger">{{$errors->first('new_pin')}}</p>
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
        function getPin(object) {
            if (object.value){
                $.ajax({
                    url: '{{ route('get_employee') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    cache: false,
                    data:{
                        id: object.value
                    },
                    success: function (response) {
                        employee_old_pin = response.old_pin ?? ''
                        employee_new_pin = response.new_pin ?? ''
                        $('#old_pin').val(employee_old_pin);
                        $('#new_pin').val(employee_new_pin);
                    },
                    error: function (xhr) {
                        employee_old_pin = ''
                        employee_new_pin = ''
                    }
                });
            }
        }
        function getEmployeeFromPin(object) {
            if (object.value && object.value.length > 3){
                $.ajax({
                    url: '{{ route('get_employee_from_pin') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    cache: false,
                    data:{
                        pin: object.value
                    },
                    success: function (response) {
                        employee_id = response.id ?? ''
                        console.log(employee_id)
                        $('#employee_id').val(employee_id).trigger('change');
                    },
                    error: function (xhr) {
                        employee_id = ''
                    }
                });
            }
        }
    </script>
@if(!request()->ajax()) @endsection @endif
