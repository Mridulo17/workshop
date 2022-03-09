@extends('admin.layouts.master')

@section('title') @lang('product.index') @endsection

@section('css')

@endsection

@section('thead')
    <tr>
        <th width="5%">#</th>
        <th>@lang('common.tracking_no')</th>
        <th>@lang('product.type')</th>
        <th>@lang('product.category')</th>
        <th>@lang('product.brand')</th>
        <th>@lang('product.model')</th>
        <th>@lang('fire_station.fire_station')</th>
        <th> @lang('product.registration_divisional')
             @lang('product.number')</th>
        <th width="5%">@lang('product.status')</th>
        <th width="15%">@lang('product.action')</th>
    </tr>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('title')@lang('product.index')@endslot
        @slot('create_button')
            <a href="{{route('product.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">
                <i class="fa fa-plus-circle"></i> @lang('product.create')
            </a>
        @endslot
    @endcomponent

    <div class="card">
        <div class="card-body search-product">
            <form action="{{--{{route('product.index')}}--}}" method="GET" id="product_search_form">
                <input type="hidden" value="{{$workshop_id}}" name="map_workshop_id">

                <div class="row">
                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
                            $error_class = $errors->has('workshop_id') ? 'parsley-error ' : ''; @endphp
                        <label for="workshop_id" class="form-label">@lang('workshop.workshop')</label>
                        <div class="form-group">
                            <select name="workshop_id" id="workshop_id" class="{{$error_class}} form-control select2
                            workshop_id"
                                    onchange="findDivision(this)">
                                <option value="">@lang('common.all')</option>
                                @foreach($workshops as $key=>$workshop)
                                    <option value="{{$key}}" @if($workshop_id==$key) {{'selected'}} @endif>{{$workshop}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('workshop_id'))
                                <p class="text-danger">{{$errors->first('workshop_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
            $error_class = $errors->has('division_id') ? 'parsley-error ' : ''; @endphp
                        <label for="division_id" class="form-label">@lang('division.division')</label>
                        <div class="form-group">
                            <select name="division_id" id="division_id" class="{{$error_class}} form-control select2
                        division_id"
                                    onchange=SelectChange("{{route('get_districts')}}","district_id",this)>
                               <option value="">@lang('common.all')</option>
                                @foreach($divisions as $key=>$division)
                                    <option value="{{$key}}">{{$division}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('division_id'))
                                <p class="text-danger">{{$errors->first('division_id')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
            $error_class = $errors->has('district_id') ? 'parsley-error ' : ''; @endphp
                        <label for="district_id" class="form-label">@lang('district.district')</label>
                        <div class="form-group">
                            <select name="district_id" id="district_id" class="{{$error_class}} form-control select2
                        district_id"
                                    onchange=SelectChange("{{route('get_thanas')}}","thana_id",this)>
                               <option value="">@lang('common.all')</option>
                                @foreach($districts as $key=>$district)
                                    <option value="{{$key}}">{{$district}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('district_id'))
                                <p class="text-danger">{{$errors->first('district_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
            $error_class = $errors->has('thana_id') ? 'parsley-error ' : ''; @endphp
                        <label for="thana_id" class="form-label">@lang('thana.thana')</label>
                        <div class="form-group">
                            <select name="thana_id" id="thana_id" class="{{$error_class}} form-control select2
                        thana_id"
                                    onchange=SelectChange("{{route('get_fire_station_from_thana')}}","fire_station_id",this) >
                                <option value="">@lang('common.all')</option>
                                @foreach($thanas as $key=>$thana)
                                    <option value="{{$key}}">{{$thana}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('thana_id'))
                                <p class="text-danger">{{$errors->first('thana_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
            $error_class = $errors->has('fire_station_id') ? 'parsley-error ' : ''; @endphp
                        <label for="fire_station_id" class="form-label">@lang('fire_station.fire_station')</label>
                        <div class="form-group">
                            <select name="fire_station_id" id="fire_station_id" class="{{$error_class}} form-control select2
                        fire_station_id"  >
                                <option value="">@lang('common.all')</option>
                                @foreach($fire_stations as $key=>$fire_station)
                                    <option value="{{$key}}">{{$fire_station}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('fire_station_id'))
                                <p class="text-danger">{{$errors->first('fire_station_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
            $error_class = $errors->has('type_id') ? 'parsley-error ' : ''; @endphp
                        <label for="type_id" class="form-label">@lang('product.product')</label>
                        <div class="form-group">
                            <select name="type_id" id="type_id" class="{{$error_class}} form-control select2
                        type_id"  >
                               <option value="">@lang('common.all')</option>
                                @foreach($types as $key=>$type)
                                    <option value="{{$key}}">{{$type}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('type_id'))
                                <p class="text-danger">{{$errors->first('type_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 my-2">
                        @php /** @var string $errors */
            $error_class = $errors->has('status') ? 'parsley-error ' : ''; @endphp
                        <label for="status" class="form-label">@lang('product.status')</label>
                        <div class="form-group">
                            <select name="status" id="status" class="{{$error_class}} form-control select2
                        status">
                                <option value="">@lang('common.all')</option>
                                <option value="Active">@lang('product.active')</option>
                                <option value="Inactive">@lang('product.inactive')</option>
                            </select>
                            @if ($errors->has('status'))
                                <p class="text-danger">{{$errors->first('status')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="search_button">Search</button>
                <button type="button" class="btn btn-warning" id="clear_search">Clear</button>
            </form>
        </div>
    </div>


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link text-primary active" id="all_btn_tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                @lang('common.index_list')
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link text-primary" id="vehicle_btn_tab" data-bs-toggle="tab" data-bs-target="#vehicle"
                    type="button" role="tab" aria-controls="vehicle" aria-selected="true">
                @lang('common.vehicle')
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link text-primary" id="pump_btn_tab" data-bs-toggle="tab" data-bs-target="#pump"
                    type="button" role="tab" aria-controls="pump" aria-selected="true">
                @lang('common.pumps')
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link text-primary" id="equipment_btn_tab" data-bs-toggle="tab" data-bs-target="#equipment"
                    type="button" role="tab" aria-controls="equipment" aria-selected="true">
                @lang('common.equipments')
            </button>
        </li>

        @if(\App\Helpers\MenuHelper::CustomElementPermission('deleted_list'))
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary" id="deleted_btn_tab" data-bs-toggle="tab" data-bs-target="#deleted_list" type="button" role="tab" aria-controls="deleted" aria-selected="false">
                    @lang('common.deleted_list')
                </button>
            </li>
        @endif
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-bordered table-hover dt-responsive w-100">
                                <thead class="thead-dark">
                                    @yield('thead')
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="vehicleDatatable" class="table table-bordered table-hover dt-responsive nowrap w-100">
                                <thead class="thead-dark">
                                @yield('thead')
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show" id="pump" role="tabpanel" aria-labelledby="pump-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="pumpDatatable" class="table table-bordered table-hover dt-responsive nowrap
                            w-100">
                                <thead class="thead-dark">
                                @yield('thead')
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show" id="equipment" role="tabpanel" aria-labelledby="equipment-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="equipmentDatatable" class="table table-bordered table-hover dt-responsive nowrap
                            w-100">
                                <thead class="thead-dark">
                                @yield('thead')
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="deleted_list" role="tabpanel" aria-labelledby="deleted_list_tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="deleted_list_datatable" class="table table-bordered table-hover dt-responsive nowrap w-100">
                                <thead class="thead-dark">
                                    @yield('thead')
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        let datatable_columns = [
            {data: 'DT_RowIndex',name:"DT_RowIndex", orderable: false, searchable: false},
            {data: 'tracking_no',name: 'tracking_no',},
            {data: 'type.bn_name',name: 'type.bn_name',},
            {data: 'category.bn_name',name: 'category.bn_name',},
            {data: 'brand.bn_name',name: 'brand.bn_name',},
            {data: 'model.bn_name',name: 'model.bn_name',},
            {data: 'fire_station.bn_name',name: 'fire_station.bn_name', defaultContent: ''},
            {data: 'registration_number',name: 'registration_number', defaultContent: ''},
            {data: 'status',name: 'status',},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]

        let datatable_columns_defs = [
            {'bSortable': true, 'aTargets': [0,1,2,3,4]},
            {'bSearchable': false, 'aTargets': [0]},
            { className: 'text-center', targets: [0,4,5] },
            { className: 'text-uppercase', targets: [1] },
        ]

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            serverMethod: 'get',
            lengthMenu: [10, 25, 50,100],
            order: [ 0, "asc" ],
            language: {
                'loadingRecords': '&nbsp;',
                'processing': 'Loading ...'
            },
            ajax: {
                url: '{{ route('product.index') }}',
                type: 'get',
                dataType: 'JSON',
                cache: false,
                "data": function(d){
                    $.each($('#product_search_form').serializeArray(), function(i, obj){
                        // console.log(obj['value']);
                        d['form_'+obj['name']] = obj['value'];
                    });
                },
            },
            columns: datatable_columns,
            search: {
                "regex": true
            },
            columnDefs: datatable_columns_defs,
        });

        $(document).on('click','#clear_search',function () {
            $(this).closest('form').find("input[type=hidden], select").val("");
            $('.select2').select2();
            window.history.replaceState({}, document.title, window.location.pathname)
        });

        $(document).on('click','#search_button',function () {
            $('#datatable').DataTable().ajax.reload();
        });



        $('#vehicleDatatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            serverMethod: 'get',
            lengthMenu: [10, 25, 50,100],
            order: [ 0, "asc" ],
            language: {
                'loadingRecords': '&nbsp;',
                'processing': 'Loading ...'
            },
            ajax: {
                url: '{{ route('product.vehicles') }}',
                type: 'get',
                dataType: 'JSON',
                cache: false,
            },
            columns: datatable_columns,
            search: {
                "regex": true
            },
            columnDefs: datatable_columns_defs,
        });

        $('#pumpDatatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            serverMethod: 'get',
            lengthMenu: [10, 25, 50,100],
            order: [ 0, "asc" ],
            language: {
                'loadingRecords': '&nbsp;',
                'processing': 'Loading ...'
            },
            ajax: {
                url: '{{ route('product.pumps') }}',
                type: 'get',
                dataType: 'JSON',
                cache: false,
            },
            columns: datatable_columns,
            search: {
                "regex": true
            },
            columnDefs: datatable_columns_defs,
        });

        $('#equipmentDatatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            serverMethod: 'get',
            lengthMenu: [10, 25, 50,100],
            order: [ 0, "asc" ],
            language: {
                'loadingRecords': '&nbsp;',
                'processing': 'Loading ...'
            },
            ajax: {
                url: '{{ route('product.equipments') }}',
                type: 'get',
                dataType: 'JSON',
                cache: false,
            },
            columns: datatable_columns,
            search: {
                "regex": true
            },
            columnDefs: datatable_columns_defs,
        });

        let tab = '{{@$active_tab}}';
        let url = '/admin/product/index';
        let id = 'datatable';
        if (tab != null){
            id = tab+'_btn_tab';
            $('#'+id).trigger('click');
        }

        @if(\App\Helpers\MenuHelper::CustomElementPermission('deleted_list'))
            $('#deleted_list_datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                serverMethod: 'get',
                lengthMenu: [10, 25, 50,100],
                order: [ 0, "asc" ],
                language: {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading ...'
                },
                ajax: {
                    url: '{{ route('product.deleted_list') }}',
                    type: 'get',
                    dataType: 'JSON',
                    cache: false,
                },
                columns: datatable_columns,
                search: {
                    "regex": true
                },
                columnDefs: datatable_columns_defs,
            });
        @endif

        $('#fire_station_id').on('change', function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: '{{route('find_fire_station')}}',
                type: 'post',
                dataType: 'JSON',
                data : {id: $('#fire_station_id').val()},
                cache: false,
                success: function (response) {
                    console.log(response)
                    $('#workshop_id').val(response.workshop.id)
                    $('#division_id').val(response.fire_station.division_id)
                    $('#district_id').val(response.fire_station.district_id)
                    $('#thana_id').val(response.fire_station.thana_id)

                    $('.select2').select2()

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

        function findDivision(value){
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: '{{ route('get_divisions_by_workshop') }}',
                type: 'post',
                dataType: 'JSON',
                data : {id: $('#workshop_id').val()},
                cache: false,
                success: function(result){
                    console.log(result);
                    $('#division_id').val(result.id)
                    $('.select2').select2()
                }});
        }
        {{--SelectChange("{{route('get_divisions_by_workshop')}}","workshop_id",this)--}}

    </script>

    @include('components.delete_script')

@endsection
