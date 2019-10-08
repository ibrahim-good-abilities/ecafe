@extends('parista-layout')
@section('title', __('All Orders'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/slick/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/slick/slick-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/parista.css')}}">
@endsection
@section('middle_content')
@if ($message = Session::get('success'))
<div class="card-alert card gradient-45deg-green-teal">
    <div class="card-content white-text">
        <p>
        <i class="material-icons">check</i> {{ $message }}</p>
</div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<div class="col s12">
    <div id="orders">


            @foreach($orders as $order)
                <div>
                    <div class="order-box">
                        <ul id="issues-collection" class="collection z-depth-1">
                            <li class="collection-item avatar">
                                <i class="material-icons green accent-2 circle">attach_file</i>
                                <h6 class="collection-header m-0">Order #{{$order->id}}</h6>
                                <p>Table @ {{$order->table_number}}</p>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s8">
                                        <p class="collections-title font-weight-600">زبادى خلاط X 5</p>
                                    </div>
                                    <div class="col s4 center-align">
                                        <a class="waves-effect waves-light blue btn btn-small btn-fluid">جاهز</a>
                                    </div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s8">
                                        <p class="collections-title font-weight-600">زبادى خلاط X 5</p>
                                    </div>
                                    <div class="col s4 center-align">
                                        <a class="waves-effect waves-light blue btn btn-small btn-fluid">جاهز</a>
                                    </div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s8">
                                        <p class="collections-title font-weight-600">زبادى خلاط X 5</p>
                                    </div>
                                    <div class="col s4 center-align">
                                        <a class="waves-effect waves-light deep-orange btn btn-small btn-fluid">تحضير</a>
                                    </div>
                                </div>
                            </li>
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s12">
                                        <p class="right-align">{{$order->notes}}</p>
                                    </div>

                                    <div class="col s12 center-align">
                                        <a class="waves-effect waves-light blue btn btn-small">@if($order->status=='pending'){{__('Done')}}@endif</a>
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach

    </div>
</div>

@section('page_js')
<script src="{{asset('resources/vendors/slick/slick.min.js')}}" type="text/javascript"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js" type="text/javascript"></script>
<script src="{{asset('resources/js/parista.js')}}" type="text/javascript"></script>
@endsection
@endsection
