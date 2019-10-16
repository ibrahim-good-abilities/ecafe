@extends('layouts.captain')
@section('title', 'E-Café')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/slick/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/slick/slick-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/captain.css')}}">
@endsection

@section('top-nav-content')
    <div id="active-orders">
        @foreach($orders as $single_order)
            <div data-number="{{ $single_order->id }}"  class="order-number" data-href="{{ route('captain-order',$single_order->id) }}">
                {{ $single_order->table_number }}
            </div>
        @endforeach
    </div>
@endsection

@section('middle_content')

<!-- Point of sale make order screen -->
<?php
    $color_palette =[
        '#7c0a02',
        '#2a1a5e',
        '#f45905',
        '#445c3c',
        '#42b883',
        '#32dbc6',
        '#1089ff',
        '#5edfff',
        '#470938',
        '#42b883',
        '#f75f00',
        '#e3c878',
        '#ed0cef',
        '#01d28e',
        '#f6f078',
        '#443737',
        '#3c4245',
        '#fc7fb2',
        '#b030b0',
        '#3e64ff'
];
?>
<div class="row" id="pos-container">
    <div class="col s5">
        <!-- checkout page -->
        @include('pos.checkout')
    </div>
    <div class="col s7">
        <!-- Products menu -->
        @include('pos.menu-captain')
    </div>
    <input type="hidden" id ="_notification_token" value="{{ csrf_token()}}"/>
</div>
<div style="bottom: 185px; right: 19px;" class="fixed-action-btn direction-top">
<a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow" id="call_cashier"data-sender="{{__('captain')}}">
<i class="material-icons tooltipped" data-position="left" data-tooltip="{{__('Call Cashier')}}">call</i>
</a>
</div>

<div style="bottom:120px; right: 19px;" class="fixed-action-btn direction-top">
<a class="btn-floating btn-large gradient-45deg-light-red-cyan gradient-shadow" id="call_parista" data-sender="{{__('captain')}}">
<i class="material-icons tooltipped" data-position="left" data-tooltip="{{__('Call Parista')}}" >call</i>
</a>
</div>
<div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top">
<a href="{{ route('captain') }}" class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow">
<i class="material-icons tooltipped" data-position="left" data-tooltip="{{__('Add New Order')}}">add</i>
</a>
</div>
@section('page_js')
<script>
    var language = "{{asset('resources/json/Arabic.json')}}";
</script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/vendors/slick/slick.min.js')}}" type="text/javascript"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js" type="text/javascript"></script>
<script src="{{ asset('resources/js/captain.js')}}" type="text/javascript"></script>
@endsection
@endsection
