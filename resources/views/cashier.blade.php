@extends('parista-layout')
@section('title', __('All Orders'))
@section('page_css')

<link rel="stylesheet" type="text/css" href="{{asset('resources/css/cashier.css')}}">
@endsection
@section('middle_content')

<div class="empty-orders">
    <h4>لا يوجد لديك طلبات الان </h4>
</div>

<input type="hidden" id ="_order_token" value="{{ csrf_token()}}"/>


    <div class="row">
          @foreach($orders as $order)
        <div class="col s4 order-content " data-order_id="{{$order->id}}">
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
                                <ul class="order-items style-1">
                                    @foreach($order_items as $item)
                                    <li class="collection-item">
                                        <div class="row">
                                            <div class="col s6">
                                                <p class="collections-title font-weight-600">{{ $item->name}} X {{ $item->quantity}}</p>

                                            </div>

                                            <div class="col s6 center-align">
                                            <p class="item-price">({{$item->price *$item->quantity}} ج)</p>
                                             </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <li class="collection-item">
                                    <div class="row">
                                        <div data-order_id="{{$order->id}}" data-order_total="{{ $order->subtotal - $order->discount }}" class="col s12 center-align">
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

<div id="payment" class="modal">
   <form action="#">
           @csrf
           <div class="modal-content row">
                   <div class="frist-line col s12">
                               <span class="frist-text"> المبلغ الاجمالي</span>
                               <p id="total"  name="order_total" value="" >000</p>
                   </div>
                       <div class="middle-line col s12">
                       <span class="middle-input">
                           <input placeholder="المدفوع"  type="number" id="input"  step="0.25" min=".25" class="validate">
                       </span>
                       <span class="middle-text"> المبلغ المدفوع</span>
                       </div>
                   </div>
                     <input type="hidden" name="order_id"/>
                   <div class="third-line col s12">
                               <span class="third-text"> المبلغ المتبقي</span>
                               <p id="val" class="left-text" name="order_total" >0000</p>
                   </div>
                   <div class="modal-footer">

                       <div class="button-wrapper">
                             
                                 <button  class="btn cyan waves-effect waves-light right" id="payment2" type="submit">{{ __('Payment') }}</button>
                            
                           
                       </div>
                   </div>
           </div>
   </form>
</div>
<div id="bill" class="modal" style="width: 37%;">
  
               
         <div class="print" id="modal-print">
       
               <div class="invoice">
   
                   <img src=" {{ asset('resources/images/logo/materialize-logo-color.png') }}"  >
                   <h6>Sale NO. : <span id="order_id"> xxx </span> </h6>
               </div>
               <br>
               <div class="invoice-title">
                 Date : &nbsp; &nbsp;<b id="order_date"> xx-xx-xxxx</b>
               </div>


               <div class="invoice-title" >
                  Customer/Table : <b id="order_table">xxx</b>
               </div>
               <br>
                           <div>
                              <table class="table" id="order_details">
                                    <thead>
                                    <tr>
                                       <td class="text-center"><strong>#</strong></td>
                                       <td class="text-center"><strong>Product</strong></td>
                                       <td class="text-center"><strong>Quantity</strong></td>
                                       <td class="text-center"><strong>SubTotal</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center">Total Items</td >
                                            <td class="text-center"><span id="total_quantity"></span>  Total</td >     
                                            <td class="text-center" ></td >
                                            <td class="text-center bold" id="sub_total">xxx</td >       
                                        </tr>
                                        <tr>
                                            <td class="text-center">Discount</td >
                                            <td class="text-center"></td >     
                                            <td class="text-center"></td>
                                            <td class="text-center bold" id="discount" >xxx </td>       
                                        </tr>
                                        <tr>
                                            <td class="text-center">Grand Total</td >
                                            <td class="text-center"></td >     
                                            <td class="text-center"></td >
                                            <td class="text-center bold" id="grand_total">xxx </td>       
                                        </tr>
                                        <tr>
                                            <td class="text-center">Paid</td >
                                            <td class="text-center"></td >     
                                            <td class="text-center"></td >
                                            <td class="text-center bold" id="paid">xxx</td>       
                                        </tr>
                                    </tfoot>
                              </table>
                           </div>
   </div>
   <div class="right-align">
   <a id="close" class="waves-effect waves-light  btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1">close</a>
   <a class="waves-effect waves-light  btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1"id="print">Print</a>
   
   </div>
                        

</div>
<div style="bottom: 120px; right: 19px;" class="fixed-action-btn direction-top">
<a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow" id="call_captain" data-sender="{{__('cashier')}}"
>
<i class="material-icons tooltipped" data-position="left" data-tooltip="{{__('Call Captain')}}">call</i>
</a>
</div>

<div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top">
<a class="btn-floating btn-large gradient-45deg-light-red-cyan gradient-shadow" id="call_parista" data-sender="{{__('cashier')}}">
<i class="material-icons tooltipped" data-position="left" data-tooltip="{{__('Call Parista')}}">call</i>
</a>
</div>



@section('page_js')

<script src="https://js.pusher.com/5.0/pusher.min.js" type="text/javascript"></script>
<script src="{{asset('resources/js/cashier.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/js/printThis.js')}}" type="text/javascript"></script>
@endsection
@endsection
