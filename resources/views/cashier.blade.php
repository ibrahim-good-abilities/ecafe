@extends('parista-layout')
@section('title', __('All Orders'))
@section('page_css')

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

    


                    <div class="empty-orders">
                        <h4>لا يوجد لديك طلبات الان </h4>
                    </div>
 

            <input type="hidden" id ="_order_token" value="{{ csrf_token()}}"/>
           
<div class="container">
    <div class="row">
          @foreach($orders as $order)
        <div class="col s4 order-content">
                                                    
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
 
               
    <div>
</div>     

<div id="payment" class="modal">
    <form action="{{ route('main_stock_operations') }}" method="post">
            @csrf
            <div class="modal-content row">
                    <div class="frist-line col s12">
                                <span class="frist-text"> المبلغ الاجمالي</span>
                                <span class="left-text">100</span>
                               
                    </div>
                        <div class="middle-line col s12">
                        <span class="middle-input"> 
                            <input placeholder="المدفوع"  type="number"  step="0.25" min=".25" id="input"class="validate">
                        </span>
                        <span class="middle-text"> المبلغ المدفوع</span>
                      

                        </div>
                    </div>

                    <div class="third-line col s12">
                                <span class="third-text"> المبلغ المتبقي</span>
                                <span class="left-text">100</span>    
                    </div>
                    <div class="modal-footer">
                        <div class="button-wrapper">
                            <button class="btn cyan waves-effect waves-light right" type="submit">{{ __('Payment') }}
                            <i class="material-icons right">done</i>
                            </button>
                        </div>
                    </div>


            </div>

    </form>
</div>


@section('page_js')

<script src="https://js.pusher.com/5.0/pusher.min.js" type="text/javascript"></script>
<script src="{{asset('resources/js/cashier.js')}}" type="text/javascript"></script>
@endsection
@endsection
