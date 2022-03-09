@extends('admin.layouts.master')

@section('title') @lang('product.index') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1_link'){{ route('product.index') }}@endslot
        @slot('li_1')@lang('common.index',['model' => trans('product.product')])@endslot
        @slot('li_2')@lang('common.view',['model' => trans('product.product')])@endslot
        @slot('title')@lang('common.view',['model' => trans('product.product')])@endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th colspan="4" class="p-2 text-center bg-secondary font-size-14 text-white text-uppercase">
                                {{ $product->tracking_no }} @lang('product.product_details')
                            </th>
                        </tr>
                        </thead>
                        <tbody class="thead-dark">

                        <tr>
                            <th class="">@lang('common.tracking_no')</th>
                            <td class="text-uppercase">{{ $product->tracking_no }}</td>
                            <th class="">@lang('common.barcode')</th>
                            <td class="text-uppercase">
                                {!! \DNS1D::getBarcodeHTML($product->tracking_no, 'C39+',1,30) !!}
                                <a download="{{$product->tracking_no}}.png" href="data:image/png;base64,{!! \DNS1D::getBarcodePNG($product->tracking_no, 'C39+',5,200) !!}">Download</a>
                            </td>

                        </tr>

                        <tr>
                            <th>@lang('product.type')</th>
                            <td class="text-uppercase">{{  $product->type->bn_name }}</td>
                            <th>@lang('category.category')</th>
                            <td class="text-uppercase"> {{ $product->category->bn_name }} </td>
                        </tr>

                        <tr>
                            <th>@lang('product.brand')</th>
                            <td class="text-uppercase">{{ $product->brand->bn_name }}</td>
                            <th>@lang('product.model')</th>
                            <td class="text-uppercase">{{$product->model->bn_name}}</td>
                        </tr>

                        <tr>
                            <th>@lang('product.country')</th>
                            <td class="text-uppercase">{{ @$product->model->country->bn_name }}</td>
                            <th>@lang('product.manufacturer_year')</th>
                            <td class="text-uppercase">{{ $product->manufacturer_year }}</td>
                        </tr>

                        <tr>
                            <th>@lang('product.entry_date')</th>
                            <td class="text-uppercase">{{ $product->entry_date }}</td>
                            <th>@lang('product.registration_divisional')</th>
                            <td class="text-uppercase">{{ $product->registration_number }}</td>
                        </tr>

                        <tr>
                            <th>@lang('product.capacity')</th>
                            <td class="text-uppercase">{{ $product->capacity }}</td>
                            <th>@lang('product.fuel')</th>
                            <td class="text-uppercase">{{ $product->fuel }}</td>
                        </tr>

                        <tr>
                            <th>@lang('product.engine_number')</th>
                            <td class="text-uppercase">{{ $product->engine_number }}</td>
                            <th>@lang('product.chassis_number')</th>
                            <td class="text-uppercase">{{ $product->chassis_number }}</td>
                        </tr>


                        <tr>
                            <th>@lang('product.cylinder_number')</th>
                            <td class="text-uppercase">{{ $product->cylinder_number }}</td>
                            <th>@lang('product.weight')</th>
                            <td class="text-uppercase">{{ $product->weight }}</td>
                        </tr>


                        <tr>
                            <th>@lang('product.volume')</th>
                            <td class="text-uppercase">{{ $product->volume }}</td>
                            <th>@lang('product.horsepower')</th>
                            <td class="text-uppercase">{{ $product->horsepower }}</td>
                        </tr>

                        <tr>
                            <th>@lang('product.tire_size')</th>
                            <td class="text-uppercase">{{ $product->tire_size }}</td>
                            <th>@lang('product.tire_number')</th>
                            <td class="text-uppercase">{{ $product->tire_number }}</td>
                        </tr>

                        <tr>
                            <th>@lang('product.status')</th>
                            <td class="text-uppercase">{{ $product->status }}</td>
                            <th>@lang('workshop.workshop')</th>
                            <td class="text-uppercase">{{ $product->workshop->bn_name }}</td>
                        </tr>

                        <tr>
                            <th>@lang('fire_station.fire_station')</th>
                            <td class="text-uppercase">{{ $product->fire_station->bn_name }}</td>
                            <th>@lang('common.section')</th>
                            <td class="text-uppercase">{{ $product->section }}</td>
                        </tr>


                        <tr>
                            <th>@lang('common.building')</th>
                            <td class="text-uppercase">{{ $product->building }}</td>
                            <th>@lang('common.floor')</th>
                            <td class="text-uppercase">{{ $product->floor }}</td>
                        </tr>

                        <tr>
                            <th>@lang('common.block')</th>
                            <td class="text-uppercase">{{ $product->block }}</td>
                            <th>@lang('common.rack')</th>
                            <td class="text-uppercase">{{ $product->rack }}</td>
                        </tr>

                        <tr>
                            <th>@lang('common.row')</th>
                            <td class="text-uppercase">{{ $product->row }}</td>
                            <th>@lang('common.column')</th>
                            <td class="text-uppercase">{{ $product->column }}</td>
                        </tr>

                        <tr>
                            <th colspan="1">@lang('common.image')</th>
                            @if(!$product->files->isEmpty())
                                <td class="text-uppercase" colspan="3">
                                    <div id="carouselExampleControls" class="carousel slide text-center"
                                         data-bs-ride="carousel">
                                        <div class="carousel-inner mb-2">
                                            @foreach($product->files as $image)
                                                <div class="carousel-item  {{ $loop->iteration == 1 ? 'active': ''}} ">
                                                    <img src="{{ asset($image->source) }}" class="d-block center
                                                    w-35" alt="Images" style="display: block;margin-left: auto;
                                                    margin-right: auto;width: 35%;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="btn btn-dark btn-sm center" type="button"
                                                data-bs-target="#carouselExampleControls"
                                                data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon center"
                                                  aria-hidden="true" style="width: 10px;height: 10px; "></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="btn btn-dark btn-sm center" type="button"
                                                data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon center" aria-hidden="true"
                                                  style="width: 10px;height: 10px;"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </td>
                            @else
                                <td class="text-uppercase">@lang('common.no_image')</td>
                            @endif
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection

{{--<script>--}}
{{--    var myCarousel = document.querySelector('#myCarousel')--}}
{{--    var carousel = new bootstrap.Carousel(myCarousel)--}}
{{--</script>--}}
