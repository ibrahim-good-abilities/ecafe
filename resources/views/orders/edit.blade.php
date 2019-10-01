@extends('layout')
@section('title', __('Edit Order'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/pages/dashboard-modern.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/order-details.css')}}">

@endsection

@section('middle_content')

                    <div class="col s12 dir_rtl">
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <span class="order_label"> {{__('Order Id')}}: </span> <span>#{{ $order->id }}</span>
                            </div>
                            <div class="input-field col m6 s12">
                                <span class="order_label"> {{__('Customer Name')}}: </span> <span>{{ $order->customer_name !="" ? $order->customer_name:__('Guest')}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <span class="order_label"> {{__('Status')}}: </span><span class="badge grey lighten-5 grey-text text-accent-2">{{ __($order->status) }}</span>
                            </div>
                            <div class="input-field col m6 s12">
                                <span class="order_label"> {{__('Date Created')}}: </span> <span>{{ date('H:i:s d-m-Y', strtotime($order->created_at)) }}</span>
                            </div>
                        </div>

                    </div>



                    <table class="subscription-table responsive-table highlight">
                        <thead>
                            <tr>
                                <th>{{__('Item Name')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Price')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
              
<!-- orders Details -->

@endsection
