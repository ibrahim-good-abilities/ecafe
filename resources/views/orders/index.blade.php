@extends('layout')
@section('title', __('All Orders'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
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
<!-- orders table -->
<table id="orders" class="subscription-table highlight">
    <thead>
        <tr>
            <th>{{ __('Order Id') }}</th>
            <th>{{ __('Customer Name') }}</th>
            <th> {{ __('Date Created') }}</th>
            <th> {{ __('Time Created') }}</th>
            <th>{{__('Coupon Name')}}</th>
            <th>{{ __('Status') }}</th>
            <th>{{__('Subtotal')}}</th>
            <th>{{__('Discount')}}</th>
            <th> {{ __('Total') }}</th>
            <th>{{__('Last Update')}}</th>
            <th>{{__('Settings')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)

        <?php  $date_parts = explode(" ",  $order->created_at); ?>
        <?php  $date_parts_update = explode(" ",  $order->updated_at);?>

            <tr>
                <td>{{$order->id}}</td>
                <td>{{ $order->customer_name !="" ? $order->customer_name:__('Guest')}}</td>
                <td>{{ $date_parts[0] }}</td>
                <td>{{ $date_parts[1] }}</td>
                <td>{{$order->name}}</td>
                <td><span class="badge grey lighten-5 grey-text text-accent-2">{{ __( ucfirst($order->status)) }}</span></td>

                <td>{{number_format($order->subtotal,2)}}</td>
                <td>{{number_format($order->discount,2)}}</td>
                <td>{{number_format($order->subtotal - $order->discount,2) }}</td>
                <td>{{$date_parts_update[1]}}</td>

                <td class="left-align">
                      <a href="{{route('edit_order',$order->id)}}"><i class="material-icons">visibility</i></a>
                      <a  class="delete-with-confirmation" href="{{route('delete_order',$order->id)}}"><i class="material-icons pink-text">clear</i></a>
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
