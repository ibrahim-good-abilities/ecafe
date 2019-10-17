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
                    <?php  $date_parts = explode(" ",  $order->created_at); ?>

                    <?php  $date_parts_update = explode(" ",  $order->updated_at);?>
              
                    
<div class="col m12 dir_rtl">
    <div class="row">
         <div class="input-field col m6 s12">
            <span class="order_label"> {{__('Date Created')}}: </span> <span>{{ $date_parts[0] }}</span>
        </div>

        <div class="input-field col m6 s12">
            <span class="order_label"> {{__('Order Id')}}: </span> <span>#{{ $order->id }}</span>
        </div>

        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Time Updated')}}: </span> <span>{{ $date_parts_update[1] }}</span>
        </div>

        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Time Created')}}: </span> <span>{{ $date_parts[1] }}</span>
        </div>

        <div class="input-field col m4 s12">
            <?php
                $status_classes = '';
                if($order->status == 'pending'){
                    $status_classes = 'grey';
                }else if($order->status == 'processing'){
                    $status_classes = 'blue';
                }else if($order->status == 'ready'){
                    $status_classes = 'yellow';
                }else if($order->status == 'done'){
                    $status_classes = 'green';
                }
            ?>
            <span class="order_label"> {{__('Status')}}: </span><span class="badge text-accent-2 {{ $status_classes }}">{{ __( ucfirst($order->status)) }}</span>
        </div>

        <!-- <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Customer Name')}}: </span> <span>{{ $order->customer_name !="" ? $order->customer_name:__('Guest')}}</span> 
        </div> -->

        

        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Coupon Name') }}: </span> <span>{{ $order->name }}</span>
        </div>
        
        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Discount') }}: </span> <span>{{ $order->discount }}</span>
        </div>
        <div class="input-field col m4 s12">
            <span class="order_label"> {{__('Table Number') }}: </span> <span>{{ $order->table_number }}</span>
        </div>
    </div>

</div>

<div class="row">
<div class="col s12 m12 l4 sidebar-title">
<h4><span>{{__('Order Log') }}</span></h4>
                
                @foreach ($logs as $log)
                <div class="note_content">
                    <p> {{$log->description}}</p>
                </div>
                @endforeach
                
</div>
<div class="col s12 m12 l8">
    <table class="highlight">
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
</div>
<div  class="col s12">
        <h5 class="right-align">{{ __('Notes')}}</h5>
        <p class="right-align">{{$order->notes!=""?$order->notes:'لايوجد'}}</p>
</div>
<div class="col s12" id="update-order-section">


    <!-- <h5 class="right-align">{{ __('Update Order Status')}}</h5>
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
    </form> -->
</div>
</div>
<!-- orders Details -->
@section('page_js')
<script src="https://js.pusher.com/5.0/pusher.min.js" type="text/javascript"></script>
<script src="{{ asset('resources/js/order.js')}}" type="text/javascript"></script>
@endsection
@endsection
