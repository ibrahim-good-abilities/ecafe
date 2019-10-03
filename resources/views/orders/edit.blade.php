@extends('layout')
@section('title', __('Edit Order').' #'.$order->id)
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/pages/dashboard-modern.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/order-details.css')}}">
@endsection

@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('orders') }}">{{__('Back') }}
        <i class="material-icons right">keyboard_return</i>
    </a>
</div>
@endsection

@section('middle_content')
<!-- Point of sale make order screen -->
@if($errors->any())
    <div class="card-alert card red lighten-5 card-content red-text">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
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

<div class="col s12 dir_rtl">
    <div class="row">
        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Order Id')}}: </span> <span>#{{ $order->id }}</span>
        </div>

        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Date Created')}}: </span> <span>{{ date('H:i:s d-m-Y', strtotime($order->created_at)) }}</span>
        </div>

        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Status')}}: </span><span class="badge grey lighten-5 grey-text text-accent-2">{{ __($order->status) }}</span>
        </div>

        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Customer Name')}}: </span> <span>{{ $order->customer_name !="" ? $order->customer_name:__('Guest')}}</span>
        </div>

        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Discount') }}: </span> <span>{{ $order->discount }}</span>
        </div>

        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Coupon Name') }}: </span> <span> xxxxx </span>
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
<div id="update-order-section">
    <h5 class="right-align">{{ __('Update Order Status')}}</h5>
    <form action="{{ route('order_update_status',$order->id) }}" method="post">
        @csrf
        <div class="row">

            <div class="col s12 l6 right-align">
                <button type="submit" class="mb-6 btn waves-effect waves-light green darken-1">
                    <i class="material-icons right">done</i> {{ __('Execute') }}
                </button>
            </div>

            <div class="col s12 l6">
                <div class="input-field">
                <select name="status">
                    <option value="" disabled selected>{{ __('Choose order status') }}</option>
                    <option value="pending">{{ __('Pending') }}</option>
                    <option value="processing">{{ __('Processing') }}</option>
                    <option value="ready">{{ __('Ready') }}</option>
                    <option value="completed">{{ __('Completed') }}</option>
                </select>
                <label>{{ __('Order Status') }}</label>
                </div>               
            </div>

        </div>
    </form>
</div>
              
<!-- orders Details -->

@endsection
