@extends('guest.layouts.master')

@section('title')
    @lang('login.label_login')
@endsection

@section('css')
    .application_rules{
        @if(config('app.locale') == 'en')
            list-style: decimal;
        @else
             list-style: bengali;
        @endif

        text-align: justify;
    }

    .left_side_part,.left_side_part h4{
        color: #fff;
    }

    .left_side_part a{
        color: #49f112;
    }
@endsection

@section('body')
    <body data-topbar="dark" data-layout="horizontal">
    @endsection

    @section('content')

        <!-- start container-fluid -->
        <h5 style="visibility: hidden;">hidden</h5>
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-light font-size-18 text-center">
                        @lang('translation.noc_verify')
                    </div>
                    <div class="card-body">
                        <form class="row" action="{{ route('search_application') }}">
                            <div class="col-12">
                                <label for="tracking_number">@lang('noc_verify.tracking_number') <span class="text-danger">*</span> </label>
                                <input required name="tracking_number" placeholder="@lang('noc_verify.tracking_number_placeholder')" class="form-control" type="text">
                                <label for="tracking_number">@lang('noc_verify.client_mobile_number') <span class="text-danger">*</span> </label>
                                {{--TODO::bangla becomes double--}}
                                <input required name="mobile" placeholder="@lang('noc_verify.client_mobile_number_placeholder')" class="form-control bn_language" type="search">
                                <button class="btn btn-primary text-center mt-2" type="submit"><i class="fa fa-search text-white"></i> Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        @if(@$application)
                            <table class="table table-hover table-success <!--table-borderless-->">
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            @lang('noc_verify.application') <strong class="text-primary font-size-15">{{ $application->updated_at->format('d-m-Y') }}</strong>  @lang('noc_verify.from_date')<strong class="text-primary font-size-16"> @lang('application.'.$application->status) </strong> @lang('noc_verify.in_status')
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>
                                            <strong class="text-primary font-size-15">@lang('noc_verify.client')</strong>
                                        </th>
                                        <td>
                                            <strong class="text-primary font-size-15">
                                                {{ $application->safety_firm ? @$application->safety_firm->name : @$application->user->name }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>
                                            <strong class="text-primary font-size-15">@lang('noc_verify.application_type')</strong>
                                        </th>
                                        <td>
                                            <strong class="text-primary font-size-15">
                                                @if($application->type == 'proposed')
                                                    @lang('noc_verify.proposed')
                                                @elseif($application->type == 'existing')
                                                    @lang('noc_verify.existing')
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>
                                            <strong class="text-primary font-size-15">@lang('noc_verify.application_date')</strong>
                                        </th>
                                        <td>
                                            <strong class="text-primary font-size-15">{{ $application->created_at->format('d-m-Y') }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{--@lang('noc_verify.contact_fire_service')--}}
                        @else
                            <strong> {{ @$message }} </strong>
                            <strong class="text-warning font-size-14"> @lang('noc_verify.correct_tracking_number') </strong>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->

        <!-- JAVASCRIPT -->

    @endsection

    @section('script')
        <!-- owl.carousel js -->
        <script src="{{ URL::asset('/assets/common/libs/owl.carousel/owl.carousel.min.js') }}"></script>
        <!-- auth-2-carousel init -->
        <script src="{{ URL::asset('/assets/common/js/pages/auth-2-carousel.init.js') }}"></script>

        <script>
            $(function() {
                // show the alert
                setTimeout(function() {
                    $(".close").alert('close');
                }, 5000);
            });
        </script>

@endsection
