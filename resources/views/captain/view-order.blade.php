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
        <div class="order-number selected">
            أضافة طلب
        </div>
        <div class="order-number">
            #1
        </div>
        <div class="order-number">
            #2
        </div>
        <div class="order-number">
            #3
        </div>
        <div class="order-number">
            #4
        </div>
        <div class="order-number">
            #4
        </div>
        <div class="order-number">
            #5
        </div>
    </div>

@endsection
@section('middle_content')

<div class="row" id="pos-container">
    <div class="col s5">
        <!-- checkout page -->
        @include('pos.checkout')
    </div>
    <div class="col s7">
       
    </div>

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
<script src="{{ asset('resources/js/captain-order.js')}}" type="text/javascript"></script>
@endsection
@endsection
