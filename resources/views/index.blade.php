@extends('layout')
@section('title', 'E-Café')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/slick/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/slick/slick-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/pos.css')}}">
@endsection
@section('middle_content')
<!-- Point of sale make order screen -->

<div class="row" id="pos-container">
    <div class="col s4 l4">
        <!-- checkout page -->
        @include('pos.checkout')
    </div>
    <div class="col s6 17">
        <!-- Products menu -->
        @include('pos.menu')
    </div>
    <div class="col s2 11 ">
        <!-- Products menu -->
        @include('pos.category')
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
<script src="{{ asset('resources/js/pos.js')}}" type="text/javascript"></script>
@endsection
@endsection
