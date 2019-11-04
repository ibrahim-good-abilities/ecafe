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
<div class="row">
    <div class="col s12">

        <div class="empty-orders">
            <h4>لا يوجد لديك طلبات الان </h4>
        </div>
        <div id="orders">

            <input type="hidden" id ="_order_token" value="{{ csrf_token()}}"/>
            @foreach($orders as $order)
                <div>
                    <div class="order-box">
                        <ul class="collection z-depth-1">
                            <li class="collection-item avatar">
                                <i class="material-icons green accent-2 circle">attach_file</i>
                                <h6 class="collection-header m-0">Order #{{$order->id}}</h6>
                                <p>Table @ {{$order->table_number}}</p>
                            </li>
                            @php
                                $order_items =  App\Http\Controllers\OrderController::getOrderItems($order->id);
                            @endphp
                            @foreach($order_items as $item)
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s8">
                                        <p class="collections-title font-weight-600">{{ $item->name}} X {{ $item->quantity}}</p>
                                    </div>
                                    <div class="col s4 center-align">
                                        @if($item->status == 'pending')
                                            <button class="waves-effect waves-light teal darken-1 btn btn-small btn-fluid make-in-progress" data-item_id="{{ $item->id}}">{{__('Execution Start')}}</button>
                                            <button class="waves-effect waves-light blue btn btn-small btn-fluid make-ready hidden" data-item_id="{{ $item->id}}">{{__('Ready')}}</button>
                                            <button class="waves-effect waves-light green btn btn-small btn-fluid  disabled hidden" >{{__('Done')}}</button>
                                        @elseif($item->status == 'in progress')
                                            <button class="waves-effect waves-light blue btn btn-small btn-fluid make-ready" data-item_id="{{ $item->id}}">{{__('Ready')}}</button>
                                            <button class="waves-effect waves-light green btn btn-small btn-fluid  disabled hidden" >{{__('Done')}}</button>
                                        @else
                                            <button class="waves-effect waves-light green btn btn-small btn-fluid  disabled" >{{__('Done')}}</button>
                                        @endif
                                    </div>
                                    @if($item->note)
                                    <div class="col s12">
                                        <p class="right-align">{{$item->note}}</p>
                                    </div>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s12">
                                        <p class="right-align">{{$order->notes}}</p>
                                    </div>

                                    <div class="col s12 center-align">
                                        @if($order->status == 'pending')
                                        <button class="waves-effect waves-light green btn btn-small complete-order" data-order_id="{{ $order->id }}">{{__('Done')}}</button>
                                        <button class="waves-effect waves-light red btn btn-small hide-order hidden">{{__('Hide')}}</button>
                                        @elseif($order->status =='processing')
                                        <button class="waves-effect waves-light red btn btn-small hide-order">{{__('Hide')}}</button>
                                        @endif
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- <div style="bottom: 120px; right: 19px;" class="fixed-action-btn direction-top">
<a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow" id="call_captain" data-sender="{{__('parista')}}">
<i class="material-icons tooltipped" data-position="left" data-tooltip="{{__('Call Captain')}}">call</i>
</a>
</div>

<div style="bottom: 52px; right: 19px;" class="fixed-action-btn direction-top">
<a class="btn-floating btn-large gradient-45deg-light-red-cyan gradient-shadow" id="call_cashier" data-sender="{{__('parista')}}">
<i class="material-icons tooltipped" data-position="left" data-tooltip="{{__('Call Cashier')}}">call</i>
</a>
</div> -->
@section('page_js')
<script src="{{asset('resources/vendors/slick/slick.min.js')}}" type="text/javascript"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js" type="text/javascript"></script>
<script src="{{asset('resources/js/parista.js')}}" type="text/javascript"></script>
@endsection
@endsection
