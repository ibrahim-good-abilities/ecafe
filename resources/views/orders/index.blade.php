@extends('layout')
@section('title', __('All Orders'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection
@section('middle_content')
<!-- orders table -->
<table id="orders" class="subscription-table responsive-table highlight">
    <thead>
        <tr>
            <th>{{ __('Order Id') }}</th>
            <th>{{ __('Customer Name') }}</th>
            <th> {{ __('Date Created') }}</th>
            <th>{{ __('Status') }}</th>
            <th> {{ __('Total') }}</th>
            <th>{{__('Settings')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{ $order->customer_name !="" ? $order->customer_name:__('Guest')}}</td>
                <td>{{ $order->created_at }}</td>
                <td><span class="badge grey lighten-5 grey-text text-accent-2">{{ __($order->status) }}</span></td>
                <td>{{ $order->total }}</td>
                
                <td class="center-align">
                    <a href="#"><i class="material-icons pink-text">clear</i></a>
                    <a href="{{route('edit_order',$order->id)}}"><i class="material-icons">create</i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- orders table -->
@section('page_js')
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/js/orders.js')}}" type="text/javascript"></script>
@endsection
@endsection
