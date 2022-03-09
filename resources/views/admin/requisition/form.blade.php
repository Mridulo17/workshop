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
                <select name="requisition_place" id="requisition_place" class="form-control" required v-model="requisition_place" @change="fetch_requisition_place">
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
            <label for="station_id" class="form-label">@lang('requisition.station')</label>
            <div class="form-group">
                {{ Form::select('station_id', $requisition_data->stations, null, ['class' => $error_class.'form-control', 'v-model'=>"station_id", 'id' => 'station_id', 'placeholder' => trans('common.select'), 'required' => false, 'v-on:change'=>'fetch_station']) }}
                @if ($errors->has('station_id'))
                    <p class="text-danger">{{ $errors->first('station_id') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2" v-if="isDivision">
            @php $error_class = $errors->has('division_id') ? 'parsley-error ' : ''; @endphp
            <label for="division_id" class="form-label">@lang('requisition.division')</label>
            <div class="form-group">
                {{ Form::select('division_id', $requisition_data->divisions, null, ['class' => $error_class.'form-control', 'v-model'=>"station_id", 'id' => 'division_id', 'placeholder' => trans('common.select'), 'required' => false]) }}
                @if ($errors->has('division_id'))
                    <p class="text-danger">{{ $errors->first('division_id') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2" v-if="isDivision">
            @php $error_class = $errors->has('divisional_office') ? 'parsley-error ' : ''; @endphp
            <label for="divisional_office" class="form-label">@lang('requisition.office')</label>
            <div class="form-group">
                {{ Form::select('divisional_office', $requisition_data->divisional_offices, null, ['class' => $error_class.'form-control', 'id' => 'divisional_office', 'placeholder' => trans('common.select'), 'required' => false]) }}
                @if ($errors->has('divisional_office'))
                    <p class="text-danger">{{ $errors->first('divisional_office') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2" v-if="isDistrict">
            @php $error_class = $errors->has('district_id') ? 'parsley-error ' : ''; @endphp
            <label for="district_id" class="form-label">@lang('requisition.district')</label>
            <div class="form-group">
                {{ Form::select('district_id', $requisition_data->districts, null, ['class' => $error_class.'form-control', 'v-model'=>"station_id", 'id' => 'district_id', 'placeholder' => trans('common.select'), 'required' => false]) }}
                @if ($errors->has('district_id'))
                    <p class="text-danger">{{ $errors->first('district_id') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2" v-if="isDistrict">
            @php $error_class = $errors->has('district_office') ? 'parsley-error ' : ''; @endphp
            <label for="district_office" class="form-label">@lang('requisition.office')</label>
            <div class="form-group">
                {{ Form::select('district_office', $requisition_data->district_offices, null, ['class' => $error_class.'form-control', 'id' => 'district_office', 'placeholder' => trans('common.select'), 'required' => false]) }}
                @if ($errors->has('district_office'))
                    <p class="text-danger">{{ $errors->first('district_office') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2" v-if="isHeadquarter">
            @php $error_class = $errors->has('department_id') ? 'parsley-error ' : ''; @endphp
            <label for="department_id" class="form-label">@lang('requisition.department_id')</label>
            <div class="form-group">
                {{ Form::select('department_id', $requisition_data->departments, null, ['class' => $error_class.'form-control', 'v-model'=>"department_id", 'id' => 'department_id', 'placeholder' => trans('common.select'), 'required' => false, 'v-on:change'=>'fetch_sub_department']) }}
                @if ($errors->has('department_id'))
                    <p class="text-danger">{{ $errors->first('department_id') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-12 col-md-4 my-2" v-if="sub_departments.length > 0">
            @php $error_class = $errors->has('sub_department_id') ? 'parsley-error ' : ''; @endphp
            <label for="sub_department_id" class="form-label">@lang('requisition.sub_department_id')</label>
            <div class="form-group">
                <select name="sub_department_id" id="sub_department_id" class="form-control"
                        v-model="sub_department_id">
                    <option value="">@lang('common.select')</option>
                    <option :value="row.id" v-for="row in sub_departments"
                            v-html="row.name"></option>
                </select>
            </div>
        </div>

        {{-- <div v-if="isOffice" class="col-sm-12 col-md-4 my-2">
            {!! BootForm::select('office_id', 'Office',$offices,null,
            ['class'=>'bSelect','placeholder'=>'Select
            Office','v-model'=>"office_id",'required'=>'required'])
            !!}
        </div> --}}


        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
            <label for="type_id" class="form-label">@lang('type.type')</label>
            <div class="form-group">
                {{ Form::select('type_id',$requisition_data->types, null, ['class' => $error_class . 'form-control', 'placeholder' => trans('common.select'), 'id' => 'type_id', 'required' => false, 'v-model'=>"type_id",'v-on:change'=>'get_category']) }}
                @if ($errors->has('type_id'))
                    <p class="text-danger">{{ $errors->first('type_id') }}</p>
                @endif
            </div>
        </div>
        {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            {!! BootForm::select('type_id', 'Type',$types, null,
            ['class'=>'bSelect','placeholder'=>'Select
            type','v-model'=>"type_id",'v-on:change'=>'fetch_category'] ) !!}
        </div> --}}

        <div class="col-sm-12 col-md-4 my-2">
            @php $error_class = $errors->has('category_id') ? 'parsley-error ' : ''; @endphp
            <label for="category_id" class="form-label">@lang('category.category')</label>
            <div class="form-group">
                <select name="category_id" id="category_id" class="form-control"
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
                <select name="product_id" id="product_id" class="form-control"
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
            {!! Form::text('received_date',"Requisition Date", null,
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

@if(!request()->ajax()) @section('script') @endif
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
                    url: {
                        get_category_by_type_id_url: "{{ url('admin/get-category-by-type-id-url') }}",


                        // get_sub_department_info_url: "{{ url('fetch-sub-department-info') }}",
                        // get_station_info_url: "{{ url('fetch-station-info') }}",
                        // get_category_wise_sub_category_product_url: "{{ url('fetch-sub-category-product-info') }}",
                        // get_sub_category_wise_product_url: "{{ url('fetch-sub-category-wise-product-info') }}",
                        // get_product_info_url: "{{ url('fetch-product-info') }}",
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
                        var slug = this.requisition_place;
                        if(slug=="Station"){
                            this.isStation=true;
                            this.isDistrict=false;
                            this.isDivision=false;
                            this.isHeadquarter=false;
                        } else if(slug=="District"){
                            this.isDistrict=true;
                            this.isStation=false;
                            this.isDivision=false;
                            this.isHeadquarter=false;
                        }else if(slug=="Division"){
                            this.isDistrict=false;
                            this.isStation=false;
                            this.isDivision=true;
                            this.isHeadquarter=false;
                        } else if(slug=="Headquarter"){
                            this.isDistrict=false;
                            this.isStation=false;
                            this.isDivision=false;
                            this.isHeadquarter=true;
                        } else if(slug=="Central_Workshop"){
                            this.isDistrict=false;
                            this.isStation=false;
                            this.isDivision=false;
                            this.isHeadquarter=false;
                        }
                    },

                    // fetch_sub_department() {
                    //     var vm = this;
                    //     var slug = vm.department_id;
                    //     if (slug) {
                    //         axios.get(this.config.get_sub_department_info_url + '/' + slug).then(function (response) {
                    //             vm.sub_departments = response.data.SubDepartment;
                    //             console.log(response.data.SubDepartment);
                    //             vm.sub_department_id='';
                    //         }).catch(function (error) {
                    //             toastr.error('Something went to wrong', {
                    //                 closeButton: true,
                    //                 progressBar: true,
                    //             });
                    //             return false;
                    //         });
                    //     }
                    // },

                    // fetch_station() {
                    //     var vm = this;
                    //     var slug = vm.station_id;
                    //     if (slug) {
                    //         axios.get(this.config.get_station_info_url + '/' + slug).then(function (response) {
                    //             vm.station_type = response.data.type;
                    //             console.log(response.data.type);
                    //             vm.sub_departments='';
                    //             vm.department_id='';
                    //         }).catch(function (error) {
                    //             toastr.error('Something went to wrong', {
                    //                 closeButton: true,
                    //                 progressBar: true,
                    //             });
                    //             return false;
                    //         });
                    //     }
                    // },

                    get_category() {
                        var id = this.type_id;
                        if (id) {
                            axios
                                .get(this.url.get_category_by_type_id_url + '/' + id)
                                .then(function (response) {
                                    console.log(response);
                                    // this.categories = response.data.Category;
                                })
                                .catch(function (error) {
                                    toastr.error('Something went to wrong', {
                                        closeButton: true,
                                        progressBar: true,
                                    });
                                    return false;
                                });
                        }
                    },

                    // fetch_sub_category_and_product() {
                    //     var vm = this;
                    //     var slug = vm.category_id;
                    //     if (slug) {
                    //         axios.get(this.config.get_category_wise_sub_category_product_url + '/' + slug).then(function (response) {
                    //             if((response.data.subCategory).length){
                    //                 vm.isModel=true;
                    //                 vm.sub_categories = response.data.subCategory;
                    //             }
                    //             vm.products = response.data.products;
                    //         }).catch(function (error) {
                    //             toastr.error('Something went to wrong', {
                    //                 closeButton: true,
                    //                 progressBar: true,
                    //             });
                    //             return false;
                    //         });
                    //     }
                    // },

                    // fetch_product() {
                    //     var vm = this;
                    //     var catId = vm.category_id;
                    //     var subCatId = vm.sub_category_id;
                    //     if (subCatId) {
                    //         axios.get(this.config.get_sub_category_wise_product_url + '/' + catId + '/' + subCatId).then(function (response) {
                    //             vm.products = response.data.products;
                    //         }).catch(function (error) {
                    //             toastr.error('Something went to wrong', {
                    //                 closeButton: true,
                    //                 progressBar: true,
                    //             });
                    //             return false;
                    //         });
                    //     }
                    // },

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

                mounted() {
                $(document).trigger('vue-loaded');
                },

                updated() {
                    $(document).trigger('vue-loaded');
                    make_bangla()
                },

                // updated() {
                //     $('.bSelect').selectpicker({
                //         liveSearch: true,
                //         size: 10
                //     });
                //     $('.bSelect').selectpicker('refresh');
                // }

            });

            // $('.select2vue').select2();

        });
    </script>
@include('admin.layouts.partial.footer.vue_loaded_script')

@if(!request()->ajax()) @endsection @endif
