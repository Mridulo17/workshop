<div id="vue_app">
    <h5 class="mb-3"><b>@lang('requisition.requisition_create')</b></h5>
    <div class="row">
        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('demander_name') ? 'parsley-error ' : ''; @endphp
            <label for="demander_name" class="form-label">@lang('requisition.demander_name')</label>
            <div class="form-group">
                {{ Form::text('demander_name', null, ['class' => $error_class . 'form-control', 'id' => 'demander_name', 'required' => false]) }}
                @if ($errors->has('demander_name'))
                    <p class="text-danger">{{ $errors->first('demander_name') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('demander_rank') ? 'parsley-error ' : ''; @endphp
            <label for="demander_rank" class="form-label">@lang('requisition.demander_rank')</label>
            <div class="form-group">
                {{ Form::text('demander_rank', null, ['class' => $error_class . 'form-control', 'id' => 'demander_rank', 'required' => false]) }}
                @if ($errors->has('demander_rank'))
                    <p class="text-danger">{{ $errors->first('demander_rank') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('reference_no') ? 'parsley-error ' : ''; @endphp
            <label for="reference_no" class="form-label">@lang('requisition.reference_no')</label>
            <div class="form-group">
                {{ Form::text('reference_no', null, ['class' => $error_class . 'form-control', 'id' => 'reference_no', 'required' => false]) }}
                @if ($errors->has('reference_no'))
                    <p class="text-danger">{{ $errors->first('reference_no') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('requisition_place') ? 'parsley-error ' : ''; @endphp
            <label for="requisition_place" class="form-label">@lang('requisition.requisition_place')</label>
            <div class="form-group">
                <select name="requisition_place" id="requisition_place" class="form-control select2 bSelect" required v-model="requisition_place" @change="fetch_requisition_place">
                    <option value=''>@lang('common.select')</option>
                    <option value="Station">Station</option>
                    <option value="Division">Division</option>
                    <option value="District">District</option>
                    <option value="Headquarter">Fire Service Headquarters</option>
                    <option value="Central_Workshop">Central Workshop</option>
                </select>
                @if ($errors->has('requisition_place'))
                    <p class="text-danger">{{ $errors->first('requisition_place') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2" v-if="isStation">
            @php $error_class = $errors->has('station_id') ? 'parsley-error ' : ''; @endphp
            <label for="station_id" class="form-label">@lang('requisition.station_id')</label>
            <div class="form-group">
                <select name="station_id" id="station_id" class="form-control select2 bSelect" required v-model="station_id" @change="fetch_station">
                    <option value=''>@lang('common.select')</option>
                    <option value="Station">Station</option>
                    <option value="Division">Division</option>
                    <option value="District">District</option>
                    <option value="Headquarter">Fire Service Headquarters</option>
                    <option value="Central_Workshop">Central Workshop</option>
                </select>
                @if ($errors->has('station_id'))
                    <p class="text-danger">{{ $errors->first('station_id') }}</p>
                @endif
            </div>
        </div>





        {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-if="isStation">
            {!! Form::select('station_id', [], [],
            ['class'=>'bSelect','placeholder'=>'Select station','v-model'=>"station_id",'required'=>'required','v-on:change'=>'fetch_station']) !!}
        </div> --}}
        {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-if="isDistrict">
            {!! BootForm::select('district_id', 'District',$districts, $user_default_station,
            ['class'=>'bSelect','placeholder'=>'Select District','v-model'=>"station_id",'required'=>'required']) !!}
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-if="isDivision">
            {!! BootForm::select('division_id', 'Division',$divisions, $user_default_station,
            ['class'=>'bSelect','placeholder'=>'Select Division','v-model'=>"station_id",'required'=>'required']) !!}
        </div>

        <hr>
        <div  v-if="isHeadquarter" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            {!! BootForm::select('department_id', 'Departments',$departments,null,
            ['class'=>'bSelect','placeholder'=>'Select Department','v-model'=>"department_id",'required'=>'required','v-on:change'=>'fetch_sub_department']) !!}
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-if="sub_departments.length > 0">
            <div class="form-group">
                <label for="product_id">Sub Departments</label>
                <select name="sub_department_id" id="sub_department_id" class="form-control bSelect"
                        v-model="sub_department_id">
                    <option value="">Select one</option>
                    <option :value="row.id" v-for="row in sub_departments"
                            v-html="row.name"></option>
                </select>
            </div>
        </div>
        <div v-if="isOffice" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            {!! BootForm::select('office_id', 'Office',$offices,null,
            ['class'=>'bSelect','placeholder'=>'Select
            Office','v-model'=>"office_id",'required'=>'required'])
            !!}
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-if="isDivision">
            <div class="form-group">
                <label for="divisional_office">Office</label>
                <select name="divisional_office" id="divisional_office" class="form-control">
                    <option value="">Select one</option>
                    @foreach($offices as $office)
                        @if($office->type == 'division')
                            <option value="{{ $office->id }}">{{ $office->name_english }}</option>
                        @endif
                    @endforeach
                </select>
                <span class="badge badge-danger" id="ifDivisionNull">

                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-if="isDistrict">
            <div class="form-group">
                <label for="district_office">Office</label>
                <select name="district_office" id="district_office" class="form-control">
                    <option value="" disabled>Select one</option>
                    @foreach($offices as $office)
                        @if($office->type == 'district')
                            <option value="{{ $office->id }}" selected>{{ $office->name_english }}</option>
                        @endif
                    @endforeach
                </select>
                <span class="badge badge-danger" id="ifDistrictNull">

                </span>
            </div>
        </div> --}}


        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
            <label for="type_id" class="form-label">@lang('type.type')</label>
            <div class="form-group">
                {{ Form::select('type_id',[], null, ['class' => $error_class . 'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'type_id', 'required' => false]) }}
                @if ($errors->has('type_id'))
                    <p class="text-danger">{{ $errors->first('type_id') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
            <label for="category_id" class="form-label">@lang('category.category')</label>
            <div class="form-group">
                <select name="category_id" id="category_id" class="form-control select2 bSelect"
                        v-model="category_id" v-on:change="fetch_sub_category_and_product">
                    <option value="">@lang('common.select')</option>
                    <option :value="row.id" v-for="row in categories" v-html="row.name">
                    </option>
                </select>
                @if ($errors->has('category_id'))
                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                @endif
            </div>
        </div>

        {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" v-if="isModel">
            <div class="form-group">
                <label for="sub_category_id">Model</label>
                <select name="sub_category_id" id="sub_category_id"
                        class="form-control bSelect"
                        v-model="sub_category_id" v-on:change="fetch_product">
                    <option value="">@lang('common.select')</option>
                    <option :value="row.id" v-for="row in sub_categories" v-html="row.name">
                    </option>
                </select>
            </div>
        </div> --}}

        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('product_id') ? 'parsley-error ' : ''; @endphp
            <label for="product_id" class="form-label">@lang('requisition.product')</label>
            <div class="form-group">
                <select name="product_id" id="product_id" class="form-control select2 bSelect"
                        v-model="product_id">
                    <option value="">@lang('common.select')</option>
                    <option :value="row.id" v-for="row in products"
                            v-html="row.name"></option>
                </select>
                @if ($errors->has('category_id'))
                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                @endif
            </div>
        </div>


        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('received_date') ? 'parsley-error ' : ''; @endphp
            <label for="received_date" class="form-label">@lang('requisition.requisition_date')</label>
            <div class="form-group input-group">
                {{ Form::text('received_date', @$date ?? date('d-m-Y'), ['class' => $error_class . 'form-control datepicker', 'id' => 'received_date', 'required' => false]) }}
                <a href="javascript:" class="input-group-text text-secondary show_calendar">
                    <i class="fas fa-calendar"></i>
                </a>
                @if ($errors->has('received_date'))
                    <p class="text-danger">{{ $errors->first('received_date') }}</p>
                @endif
            </div>
        </div>

        {{-- <div class="col-lg-4 col-md-4 col-sm-12">
            {!! BootForm::text('received_date',"Requisition Date", null,
            ['class'=>'datepicker','placeholder'=>'dd/mm/yyyy','required'=>'required' ,'data-provide'=>'datepicker','
            data-date-autoclose'=>'true','autocomplete'=>'off'] ) !!}
        </div> --}}


        <div class="col-sm-12 col-md-4" style="margin-top: 34px;">
            <button type="button" class="btn btn-info btn-block" style="width: 100%;" @click="data_input">
                Add
            </button>
        </div>

        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="13%">Type</th>
                        <th width="15%">Category</th>
                        <th width="12%">Model</th>
                        <th width="20%">Name</th>
                        <th width="10%">Unit</th>
                        <th width="10%">Quantity</th>
                        <th width="12%">Purpose Of Station</th>
                        <th width="8%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(row, index) in items">
                        <td>
                            <input type="text" class="form-control input-sm"
                                    v-bind:value="row.product_type" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm"
                                    v-bind:value="row.product_category" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm"
                                    v-bind:value="row.product_sub_category" readonly>
                        </td>
                        <td>
                            <input type="hidden" :name="'products['+index+'][product_id]'"
                                    class="form-control input-sm"
                                    v-bind:value="row.product_id">

                            <input type="text" class="form-control input-sm"
                                    v-bind:value="row.product_name" readonly>
                        </td>
                        <td width="200">
                            <div class="">
                                {{-- <select :name="'products['+index+'][unit_id]'"
                                        class="form-control input-sm" required @change="valid(row,$event)">
                                    <option value="">Select one</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </td>
                        <td>
                            <input type="number" :name="'products['+index+'][quantity]'" min="0" step="1"
                                    class="form-control input-sm"  v-model="row.quantity"
                                    @change="valid(row,$event)" required>
                        </td>
                        <td>
                            <input type="text" :name="'products['+index+'][purpose_station]'"
                                    class="form-control input-sm">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-xs"
                                    @click="delete_row(row)"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="items.length > 0">
            {!! BootForm::textarea('purpose','Purpose',null,['placeholder'=>'Enter Purpose','rows'=>'2']); !!}
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="items.length > 0">
            {!! BootForm::textarea('remark','Remark',null,['placeholder'=>'Enter Description','rows'=>'2']); !!}
        </div> --}}

        {{-- @if(!$check_subUser)
            <div id="sub_user_add_button" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" v-if="items.length > 0">
                <button type="button"  class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                    আপনার সাব-ইউজার নেই। সাব-ইউজার সংযোজন করার জন্য এখানে ক্লিক করুণ।
                </button>
            </div>
        @else
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right"
                v-if="items.length > 0">
            {!! BootForm::submit('Submit',['class'=>'btn btn-primary']); !!}
        </div>
        @endif --}}
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right"
                v-if="items.length > 0">
            <button class="btn btn-primary" id="requisition_submit_button" type="submit" hidden>Submit</button>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div id="modal_error_alert" class="d-none">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-block-helper me-2"></i>
                    <span id="modal_error"></span>
                </div>
            </div>
            <div class="modal-body">
                <form class="sub_user_add" id="subUserForm" action="{{-- {{route('requisition.addSubUser')}} --}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">সাব-ইউজার সংযোজন করুন</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Sub User</span>
                                    </div>
                                    <select name="sub_user_id" class="form-control" required>
                                        <option value="">Select One</option>
                                        {{-- @foreach($subUsers as $key => $subUser)
                                            <option value="{{$key}}">{{$subUser}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Assign Date</span>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                    <input type="date" name="assign_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add SubUser</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script-bottom')

    <script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
    <script src="{{ asset('vue-js/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    config: {
                        get_sub_department_info_url: "{{ url('fetch-sub-department-info') }}",
                        get_station_info_url: "{{ url('fetch-station-info') }}",
                        get_type_wise_category_url: "{{ url('fetch-category-by-type-id') }}",
                        get_category_wise_sub_category_product_url: "{{ url('fetch-sub-category-product-info') }}",
                        get_sub_category_wise_product_url: "{{ url('fetch-sub-category-wise-product-info') }}",
                        get_product_info_url: "{{ url('fetch-product-info') }}",
                    },
                    type_id: '',
                    requisition_place: '',
                    isHeadquarter:false,
                    isStation:false,
                    isDistrict:false,
                    isDivision:false,
                    isModel:false,
                    station_id: '',
                    station_type: '',
                    department_id: '',
                    sub_department_id: '',
                    category_id: '',
                    sub_departments: [],
                    categories: [],
                    sub_category_id: '',
                    sub_categories: [],
                    product_id: '',
                    products: [],
                    items: [],
                    selectedDistrict: '',
                },
                methods: {
                    fetch_requisition_place() {
                        var vm = this;
                        console.log(vm);
                        var slug = vm.requisition_place;
                        if(slug=="Station"){
                            vm.isStation=true;
                            vm.isDistrict=false;
                            vm.isDivision=false;
                            vm.isHeadquarter=false;
                        } else if(slug=="District"){
                            vm.isDistrict=true;
                            vm.isStation=false;
                            vm.isDivision=false;
                            vm.isHeadquarter=false;
                        }else if(slug=="Division"){
                            vm.isDistrict=false;
                            vm.isStation=false;
                            vm.isDivision=true;
                            vm.isHeadquarter=false;
                        } else if(slug=="Headquarter"){
                            vm.isDistrict=false;
                            vm.isStation=false;
                            vm.isDivision=false;
                            vm.isHeadquarter=true;
                        } else if(slug=="Central_Workshop"){
                            vm.isDistrict=false;
                            vm.isStation=false;
                            vm.isDivision=false;
                            vm.isHeadquarter=false;
                        }
                    },
                    fetch_sub_department() {
                        var vm = this;
                        var slug = vm.department_id;
                        if (slug) {
                            axios.get(this.config.get_sub_department_info_url + '/' + slug).then(function (response) {
                                vm.sub_departments = response.data.SubDepartment;
                                console.log(response.data.SubDepartment);
                                vm.sub_department_id='';
                            }).catch(function (error) {
                                toastr.error('Something went to wrong', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                return false;
                            });
                        }
                    },
                    fetch_station() {
                        var vm = this;
                        var slug = vm.station_id;
                        if (slug) {
                            axios.get(this.config.get_station_info_url + '/' + slug).then(function (response) {
                                vm.station_type = response.data.type;
                                console.log(response.data.type);
                                vm.sub_departments='';
                                vm.department_id='';
                            }).catch(function (error) {
                                toastr.error('Something went to wrong', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                return false;
                            });
                        }
                    },
                    fetch_category() {
                        var vm = this;
                        var slug = vm.type_id;
                        if (slug) {
                            axios.get(this.config.get_type_wise_category_url + '/' + slug).then(function (response) {
                                vm.categories = response.data.Category;
                            }).catch(function (error) {
                                toastr.error('Something went to wrong', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                return false;
                            });
                        }
                    },
                    fetch_sub_category_and_product() {
                        var vm = this;
                        var slug = vm.category_id;
                        if (slug) {
                            axios.get(this.config.get_category_wise_sub_category_product_url + '/' + slug).then(function (response) {
                                if((response.data.subCategory).length){
                                    vm.isModel=true;
                                    vm.sub_categories = response.data.subCategory;
                                }
                                vm.products = response.data.products;
                            }).catch(function (error) {
                                toastr.error('Something went to wrong', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                return false;
                            });
                        }
                    },
                    fetch_product() {
                        var vm = this;
                        var catId = vm.category_id;
                        var subCatId = vm.sub_category_id;
                        if (subCatId) {
                            axios.get(this.config.get_sub_category_wise_product_url + '/' + catId + '/' + subCatId).then(function (response) {
                                vm.products = response.data.products;
                            }).catch(function (error) {
                                toastr.error('Something went to wrong', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                return false;
                            });
                        }
                    },
                    data_input() {
                        var vm = this;
                        if (!vm.category_id) {
                            toastr.error('Enter Category', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        } else if (!vm.product_id) {
                            toastr.error('Enter product', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        } else {
                            var slug = vm.product_id;
                            if (slug) {
                                axios.get(this.config.get_product_info_url + '/' + slug).then(function (response) {
                                    product_details = response.data;
                                    vm.items.push({
                                        product_type: product_details.type.name,
                                        product_category: product_details.category.name,
                                        product_sub_category: product_details.sub_category? product_details.sub_category.name : '',
                                        product_id: product_details.id,
                                        product_name: product_details.name,
                                    });
                                    vm.category_id = '';
                                    vm.sub_category_id = '';
                                    vm.product_id = '';

                                }).catch(function (error) {
                                    toastr.error('Something went to wrong', {
                                        closeButton: true,
                                        progressBar: true,
                                    });
                                    return false;
                                });
                            }
                        }
                    },
                    delete_row: function (row) {
                        this.items.splice(this.items.indexOf(row), 1);
                    },
                    valid: function (index,obj) {
                        var Str = obj.target.name;
                        var StrVal = obj.target.value;
                        let rslt = Str.split('][')[1].split(']')[0];
                        console.log(rslt);
                        if(rslt === 'unit_id'){
                            axios.get('/unit-type-check/'+StrVal)
                                .then(function (response) {
                                    let type = response.data.type;
                                    if(type === 1){
                                        $(obj.target).parent().parent().next().find('input').attr("step",".01");
                                    }
                                    else{
                                        $(obj.target).parent().parent().next().find('input').attr("step","1");
                                    }
                                }).catch(function (error) {
                                toastr.error('Something Went Wrong'+error, {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                return false;
                            });
                        }
                    },
                },
                updated() {
                    $('.bSelect').selectpicker({
                        liveSearch: true,
                        size: 10
                    });
                    $('.bSelect').selectpicker('refresh');
                }
            });

            $('.bSelect').selectpicker({
                liveSearch: true,
                size: 5
            });

            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy'
            });

        });


        $(document).on('submit', '.sub_user_add', function (event) {
            let modal_error_alert = $('#modal_error_alert')
            let modal_error = modal_error_alert.find('#modal_error')
            modal_error.text('')
            modal_error_alert.addClass('d-none');
            event.preventDefault();
            let vm = $(this)
            let input_array = ['input', 'select']
            vm.find('.parsley-error').remove();
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
                    $('#exampleModalCenter').modal('hide');
                    $("#subUserForm").trigger("reset");
                    {{--toastr["success1"]('{{__('আপনার নির্বাচিত সাবইউজার: ' . $users_pn_no_list . ' পিএন নং ইউজারের অধীনে আছে।')}}', 'Success');--}}
                    toastr["success"]('{{__('Sub User Created Successfully')}}', 'Success');
                    let x = document.getElementById("sub_user_add_button");
                    let y = document.getElementById("requisition_submit_button");
                    x.style.display = "none";
                    y.removeAttribute("hidden");
                },
                error: function (xhr) {
                    console.log(xhr)
                    modal_error_alert.removeClass('d-none');
                    modal_error.text('আপনার অধীনে সাবইউজার আছে।');
                }
            });
        });
    </script>
@endpush






















{{-- <style>
    table.requisition_info td {
        position: relative;
    }
    table.requisition_info td input {
        position: absolute;
        display: block;
        top:11px;
        left:0;
        margin: 0;
        height: 60%;
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid black;
        border-radius: 3px;
    }
    .btn-remove {
        background-color: #FF5C5C;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        width: 37px;
    }
    .btn-remove:hover {
        background-color: red;
    }
</style>
<h5 class="mb-3"><b>@lang('requisition.requisition_create')</b></h5>
<div class="row">
    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('demander_name') ? 'parsley-error ' : ''; @endphp
        <label for="demander_name" class="form-label">@lang('requisition.demander_name')</label>
        <div class="form-group">
            {{ Form::text('demander_name', null, ['class' => $error_class . 'form-control', 'id' => 'demander_name', 'required' => false]) }}
            @if ($errors->has('demander_name'))
                <p class="text-danger">{{ $errors->first('demander_name') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('demander_rank') ? 'parsley-error ' : ''; @endphp
        <label for="demander_rank" class="form-label">@lang('requisition.demander_rank')</label>
        <div class="form-group">
            {{ Form::text('demander_rank', null, ['class' => $error_class . 'form-control', 'id' => 'demander_rank', 'required' => false]) }}
            @if ($errors->has('demander_rank'))
                <p class="text-danger">{{ $errors->first('demander_rank') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('reference_no') ? 'parsley-error ' : ''; @endphp
        <label for="reference_no" class="form-label">@lang('requisition.reference_no')</label>
        <div class="form-group">
            {{ Form::text('reference_no', null, ['class' => $error_class . 'form-control', 'id' => 'reference_no', 'required' => false]) }}
            @if ($errors->has('reference_no'))
                <p class="text-danger">{{ $errors->first('reference_no') }}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('requisition_place') ? 'parsley-error ' : ''; @endphp
        <label for="requisition_place" class="form-label">@lang('requisition.requisition_place')</label>
        <div class="form-group">
            {{ Form::select('requisition_place',$requisition_places, null, ['class' => $error_class . 'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'requisition_place', 'required' => false]) }}
            @if ($errors->has('requisition_place'))
                <p class="text-danger">{{ $errors->first('requisition_place') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('station') ? 'parsley-error ' : ''; @endphp
        <label for="station" class="form-label">@lang('requisition.station')</label>
        <div class="form-group">
            {{ Form::select('station',[], null, ['class' => $error_class . 'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'station', 'required' => false]) }}
            @if ($errors->has('station'))
                <p class="text-danger">{{ $errors->first('station') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('type') ? 'parsley-error ' : ''; @endphp
        <label for="type" class="form-label">@lang('type.type')</label>
        <div class="form-group">
            {{ Form::select('type',[], null, ['class' => $error_class . 'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'type', 'required' => false]) }}
            @if ($errors->has('type'))
                <p class="text-danger">{{ $errors->first('type') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('category') ? 'parsley-error ' : ''; @endphp
        <label for="category" class="form-label">@lang('category.category')</label>
        <div class="form-group">
            {{ Form::select('category',[], null, ['class' => $error_class . 'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'category', 'required' => false]) }}
            @if ($errors->has('category'))
                <p class="text-danger">{{ $errors->first('category') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('sub_category') ? 'parsley-error ' : ''; @endphp
        <label for="sub_category" class="form-label">@lang('requisition.sub_category')</label>
        <div class="form-group">
            {{ Form::select('sub_category',[], null, ['class' => $error_class . 'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'sub_category', 'required' => false]) }}
            @if ($errors->has('sub_category'))
                <p class="text-danger">{{ $errors->first('sub_category') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('product') ? 'parsley-error ' : ''; @endphp
        <label for="product" class="form-label">@lang('requisition.product')</label>
        <div class="form-group">
            {{ Form::select('product',[], null, ['class' => $error_class . 'form-control select2', 'placeholder' => trans('common.select'), 'id' => 'product', 'required' => false]) }}
            @if ($errors->has('product'))
                <p class="text-danger">{{ $errors->first('product') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4 my-2">
        @php $error_class = $errors->has('requisition_date') ? 'parsley-error ' : ''; @endphp
        <label for="requisition_date" class="form-label">@lang('requisition.requisition_date')</label>
        <div class="form-group input-group">
            {{ Form::text('requisition_date', @$date ?? date('d-m-Y'), ['class' => $error_class . 'form-control datepicker', 'id' => 'requisition_date', 'required' => false]) }}
            <a href="javascript:" class="input-group-text text-secondary show_calendar">
                <i class="fas fa-calendar"></i>
            </a>
            @if ($errors->has('requisition_date'))
                <p class="text-danger">{{ $errors->first('requisition_date') }}</p>
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-4" style="margin-top: 35px;">
        <button type="submit" class="btn btn-md btn-primary waves-effect waves-light" style="width: 100%;">
            <i class="fas fa-plus-circle"></i> @lang('requisition.create')
        </button>
    </div>
</div>
<hr>
<div class="mt-2" id="requisition_details">
    <table class="table table-bordered table-hover requisition_info" id="table1">
        <thead>
            <th>Type</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Name</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Purpose Of Station</th>
            <th>Reg. No/Plate No</th>
            <th style="text-align: center;">Action</th>
        </thead>
        <tbody>
            <tr>
                <td>@lang('requisition.tracking_no')</td>
                <td>@lang('requisition.tracking_no')</td>
                <td>@lang('requisition.tracking_no')</td>
                <td>@lang('requisition.tracking_no')</td>

                <td><input type="text" id="tracking_number"></td>
                <td><input type="text" id="tracking_number"></td>
                <td><input type="text" id="tracking_number"></td>
                <td><input type="text" id="tracking_number"></td>
                <td style="text-align: center;"><button class="btn btn-sm remove btn-remove" type="button"><i class="fas fa-times"></i></button></td>
            </tr>
        </tbody>
    </table>
</div>

@if(!request()->ajax()) @section('script') @endif
<script src="{{ URL::asset('/assets/common/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/common/js/pages/form-validation.init.js') }}"></script>

<script>
    $("#table1").on('click', '.remove', function() {
        $(this).closest('tr').remove();
    })
</script>

@include('admin.layouts.partial.footer.vue_loaded_script')
@if(!request()->ajax()) @endsection @endif --}}
