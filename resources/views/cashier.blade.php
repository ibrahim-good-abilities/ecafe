@extends('parista-layout')
@section('title', __('All Orders'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/slick/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/slick/slick-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/cashier.css')}}">
@endsection
@section('middle_content')
@if ($message = Session::get('success'))
<div class="card-alert card gradient-45deg-green-teal">
    <div class="card-content white-text">
        <p>
        <i class="material-icons">check</i> {{ $message }}</p>

        <h2>hi iam </h2>
</div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<div class="col s12">


                    <div class="empty-orders">
                        <h4>لا يوجد لديك طلبات الان </h4>
                    </div>
    <div id="orders">

            <input type="hidden" id ="_order_token" value="{{ csrf_token()}}"/>
            @foreach($orders as $order)
                <div>
                    <div class="order-box">
                        <ul id="issues-collection" class="collection z-depth-1">
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

                                </div>
                            </li>
                            @endforeach
                            <li class="collection-item">
                                <div class="row">
                                    <div class="col s12">
                                        <p class="right-align">{{$order->notes}}</p>
                                    </div>

                                    <div class="col s12 center-align">
                                        <a class="modal-trigger" href="#payment">
                                            <button class="waves-effect waves-light red btn btn-small ">{{__('Payment')}}</button>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach

    </div>
</div>
<div id="payment" class="modal">
  <form action="#" method="post">
    @csrf
    <div class="modal-content ">
        <div class="row">
                <div class="input-field col s12">
                        <div class="col 8">
                            <span >123</span>
                        <div>
                        <div  class="col 4">
                            <h4>المبلغ الاجمالي</h4>
                        </div>
                </div>
                <div class="input-field col s12">
                        <div class="col 8">
                             <input  class="col s7"type="number" class="validate" name="total" id="total" required="">
                        <div>
                        <div  class="col 4">
                            <h4>المبلغ المدفوع</h4>
                        </div>
                </div>
                <div class="input-field col s12">
                        <input  class="col s7"type="number" class="validate" name="total" id="total" required="">
                        <h4 class="col s3">المتبقي</h4>
                </div>
        </div>

    </div>
    <div class="modal-footer">

      <div class="button-wrapper">
        <button class="btn cyan waves-effect waves-light right" type="submit">{{ __('Payment') }}
          <i class="material-icons right">send</i>
        </button>
      </div>
    </div>
  </form>
</div>
@section('page_js')
<script src="{{asset('resources/vendors/slick/slick.min.js')}}" type="text/javascript"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js" type="text/javascript"></script>
<script src="{{asset('resources/js/cashier.js')}}" type="text/javascript"></script>
@endsection
@endsection
