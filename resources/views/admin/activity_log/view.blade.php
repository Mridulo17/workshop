@extends('admin.layouts.master')

@section('title') @lang('activity_log.show_title') @endsection

@section('css')

@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1_link'){{route('activity_log.index')}}@endslot
        @slot('li_1')@lang('activity_log.index_title')@endslot
        @slot('li_2')@lang('activity_log.show_title')@endslot
        @slot('title')@lang('activity_log.show_title')@endslot

    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                            <tr>
                                <th>@lang('activity_log.date_time')</th>
                                <td colspan="3">{{date('d-m-Y  h:i a', strtotime($activity->created_at))}}</td>
                            </tr>
                            <tr>
                                <th>@lang('activity_log.subject')</th>
                                <td colspan="3">{{$activity->log_name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('activity_log.created_by')</th>
                                <td colspan="3">{{$activity->causer->bn_name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('activity_log.description')</th>
                                <td colspan="3">{{$activity->description}}</td>
                            </tr>
                            <tr>
                                <th>@lang('activity_log.properties_old')</th>
                                <td>
                                    @if(@$activity->properties['old'])
                                        @foreach( $activity->properties['old'] as $key => $value)
                                            <p>{{$key}}: {{$value}}</p>
                                        @endforeach
                                    @else
                                        <p>No Old Value</p>
                                    @endif
                                </td>

                                <th>@lang('activity_log.properties_new')</th>
                                <td>
                                    @foreach( $activity->properties['attributes'] as $key => $value)
                                        <p>{{$key}}: {{$value}}</p>
                                    @endforeach
                                </td>
                            </tr>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
