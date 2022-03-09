@extends('admin.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('css')
    #map {
        border: solid #00feff 2px;
        padding: 5px;
        height: 300px;
        position: relative !important;
    }
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboards @endslot
        @slot('title') Dashboard @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('product.index',['tab'=>'vehicle']) }}">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-truck"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">@lang('dashboard.vehicle')</span>
                        <span class="info-box-number">{{ $vehicles }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('product.index',['tab'=>'pump']) }}">
                <div class="info-box">
                    <span class="info-box-icon bg-pink"><i class="fas fa-pump-soap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">@lang('dashboard.pump')</span>
                        <span class="info-box-number">{{ $pumps }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('product.index',['tab'=>'equipment']) }}">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-dice-d20"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">@lang('dashboard.equipment')</span>
                        <span class="info-box-number">{{ $equipments }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('driver.index') }}" style="text-decoration: none">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-id-card-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">@lang('dashboard.driver')</span>
                        <span class="info-box-number">{{ $drivers }}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row attachstaff">

        <div class=" col-sm-8 col-md-3 my-2">
                <label for="fire_station_id" class="form-label">@lang('fire_station.fire_station')</label>
            <div class="form-group">
                {{ Form::select('fire_station_id', $fire_stations, null, ['class' => 'form-control select2 fire_station_id', 'placeholder' => trans('common.select'), 'id' => 'fire_station']) }}
            </div>
        </div>

        <div class="col-sm-8 col-md-3 my-2">
            <label for="vehicles" class="form-label">@lang('dashboard.vehicle')</label>
            <div class="form-group">
                {{ Form::text('vehicles',null, ['class' =>'form-control',
                'id' => 'vehicles', 'readonly', ]) }}
            </div>
        </div>
        <div class="col-sm-8 col-md-3 my-2">
            <label for="pump" class="form-label">@lang('dashboard.pump')</label>
            <div class="form-group">
                {{ Form::text('', /*@$fire_station_id->vehicles,*/null, ['class' =>'form-control',
                'id' => 'pump', 'readonly', ]) }}
            </div>
        </div>

        <div class="col-sm-8 col-md-3 my-2">
            <label for="equipment" class="form-label">@lang('dashboard.equipment')</label>
            <div class="form-group">
                {{ Form::text('', /*@$fire_station_id->vehicles,*/null, ['class' =>'form-control',
                'id' => 'equipment', 'readonly', ]) }}
            </div>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-12" id="map">

        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card" style="min-height: 350px;">
                <div class="card-body">
                    <h4 class="card-title mb-4">@lang('dashboard.active_users')</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>@lang('user.label_bn_name')</th>
                                    <th>@lang('user.label_email')</th>
                                    <th>@lang('user.ip_address')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($active_users as $active_user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $active_user->user->bn_name }}</td>
                                    <td>{{ $active_user->user->email }}</td>
                                    <td>{{ $active_user->ip_address }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card" style="min-height: 350px;">
                <div class="card-body">
                    <h4 class="card-title mb-4">@lang('dashboard.new_vehicle')</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>@lang('dashboard.vehicle')</th>
                                <th>@lang('product.brand')</th>
                                <th>@lang('product.model')</th>
                                <th>@lang('product.sku')</th>
                                <th>@lang('product.registration_number')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latest_vehicles as $vehicle)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vehicle->bn_name }}</td>
                                    <td>{{ $vehicle->brand->bn_name }}</td>
                                    <td>{{ $vehicle->model->bn_name }}</td>
                                    <td>{{ $vehicle->sku }}</td>
                                    <td>{{ $vehicle->registration_number }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card" style="min-height: 350px;">
                <div class="card-body">
                    <h4 class="card-title mb-4">@lang('dashboard.new_pump')</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>@lang('dashboard.pump')</th>
                                <th>@lang('product.brand')</th>
                                <th>@lang('product.model')</th>
                                <th>@lang('product.sku')</th>
                                <th>@lang('product.registration_number')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latest_pumps as $pump)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pump->bn_name }}</td>
                                    <td>{{ $pump->brand->bn_name }}</td>
                                    <td>{{ $pump->model->bn_name }}</td>
                                    <td>{{ $pump->sku }}</td>
                                    <td>{{ $pump->registration_number }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card" style="min-height: 350px;">
                <div class="card-body">
                    <h4 class="card-title mb-4">@lang('dashboard.new_equipment')</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th width="5%">#</th>
                                <th>@lang('dashboard.equipment')</th>
                                <th>@lang('product.brand')</th>
                                <th>@lang('product.model')</th>
                                <th>@lang('product.sku')</th>
                                <th>@lang('product.registration_number')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latest_equipments as $equipment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $equipment->bn_name }}</td>
                                    <td>{{ $equipment->brand->bn_name }}</td>
                                    <td>{{ $equipment->model->bn_name }}</td>
                                    <td>{{ $equipment->sku }}</td>
                                    <td>{{ $equipment->registration_number }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>

    {{--<div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4 text-center">@lang('dashboard.line_chart')</h4>

                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="mb-0"></h5>
                            <p class="text-muted text-truncate">@lang('dashboard.all_applications')</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0"></h5>
                            <p class="text-muted text-truncate">@lang('dashboard.all_applications_this_year')</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0"></h5>
                            <p class="text-muted text-truncate">@lang('dashboard.all_applications_previous_year')</p>
                        </div>
                    </div>

                    <canvas id="lineChart" style="max-height: 350px;"></canvas>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4 text-center">@lang('dashboard.bar_chart')</h4>

                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="mb-0"></h5>
                            <p class="text-muted text-truncate">@lang('dashboard.all_applications')</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0"></h5>
                            <p class="text-muted text-truncate">@lang('dashboard.all_proposed')</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0"></h5>
                            <p class="text-muted text-truncate">@lang('dashboard.all_existing')</p>
                        </div>
                    </div>

                    <canvas id="barChart" style="max-height: 350px;"></canvas>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Pie Chart</h4>

                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="mb-0">2536</h5>
                            <p class="text-muted text-truncate">Activated</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">69421</h5>
                            <p class="text-muted text-truncate">Pending</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">89854</h5>
                            <p class="text-muted text-truncate">Deactivated</p>
                        </div>
                    </div>

                    <canvas id="pie" height="260"></canvas>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Donut Chart</h4>

                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="mb-0">9595</h5>
                            <p class="text-muted text-truncate">Activated</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">36524</h5>
                            <p class="text-muted text-truncate">Pending</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">62541</h5>
                            <p class="text-muted text-truncate">Deactivated</p>
                        </div>
                    </div>

                    <canvas id="doughnut" height="260"></canvas>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Polar Chart</h4>

                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="mb-0">4852</h5>
                            <p class="text-muted text-truncate">Activated</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">3652</h5>
                            <p class="text-muted text-truncate">Pending</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">85412</h5>
                            <p class="text-muted text-truncate">Deactivated</p>
                        </div>
                    </div>

                    <canvas id="polarArea" height="300"> </canvas>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Radar Chart</h4>

                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="mb-0">694</h5>
                            <p class="text-muted text-truncate">Activated</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">55210</h5>
                            <p class="text-muted text-truncate">Pending</p>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">489498</h5>
                            <p class="text-muted text-truncate">Deactivated</p>
                        </div>
                    </div>

                    <canvas id="radar" height="300"></canvas>

                </div>
            </div>
        </div> <!-- end col -->
    </div>--}}

@endsection

@section('script')
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP_EyRuWJPXWmbSWJOmtzfDl25jCp9khg&callback=initMap&libraries=&v=weekly" async></script>

    <script>
        let map;
        let markers = @json($locations); //this should dump a javascript array object which does not need any extra interperting.
        let marks = []; //just incase you want to be able to manipulate this later

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 23.897, lng: 90.644 },
                zoom: 6.2,
            });

            for(let i = 0; i < markers.length; i++){
                marks[i] = addMarker(markers[i]);
            }
        }

        function addMarker(marker){
            let address = marker.name;
            let content = marker.lat;
            let grad = marker.lng;
            let zip = marker.location_type;
            let selected_workshop_id = marker.location_id;
            let html = "<b>" + address + "</b>";
            let markerLatlng = new google.maps.LatLng(parseFloat(marker.lat),parseFloat(marker.lng));
            let pinImage = new google.maps.MarkerImage("https://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_red.png");

            let mark = new google.maps.Marker({
                map: map,
                position: markerLatlng,
                url: '{{route('product.index')}}',
                icon: pinImage,
            });

            let infoWindow = new google.maps.InfoWindow;

            google.maps.event.addListener(mark, 'mouseover', function(){
                infoWindow.setContent(html);
                infoWindow.open(map, mark);
            });

            google.maps.event.addListener(mark, 'mouseout', function(){
                infoWindow.close(map, mark);
            });

            google.maps.event.addListener(mark, 'click', function(){
                window.location.href = mark.url+"?workshop_id="+selected_workshop_id;
                // $.ajax({
                //     type:'GET',
                //     data: {selected_workshop_id: selected_workshop_id},
                //     url: mark.url, //Your bidController route
                //     error: function (jqXHR, textStatus, errorThrown) {
                //         console.log(errorThrown)
                //     },
                //     success: function()
                //     {
                //         console.log('successful');
                //         window.location.replace(mark.url+"?workshop_id="+selected_workshop_id);
                //     }
                // });
            });
            return mark;
        }
        $(function() {
            $('#fire_station').on('change', function () {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                let fire_station_id = $('#fire_station').val();
                $.ajax({
                    url: '{{route('find_fire_station_products')}}',
                    type: 'post',
                    dataType: 'JSON',
                    data : {'fire_station_id': fire_station_id},
                    cache: false,
                    success: function (response) {
                        // console.log(response)
                        $('#vehicles').val(response)
                        // $('.select2vue').select2()

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
    </script>
    {{--<!-- apexcharts -->
    <script src="{{ URL::asset('/assets/common/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/common/libs/chart.js/Chart.bundle.min.js')}}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/common/js/pages/dashboard.init.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ URL::asset('assets/common/libs/chart-js/chart-js.min.js')}}"></script>
    <script src="{{ URL::asset('assets/common/js/pages/chartjs.init.js')}}"></script>--}}
@endsection
