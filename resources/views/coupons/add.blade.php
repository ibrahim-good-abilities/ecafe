@extends('layout')
@section('title',  __('Add Coupon'))
@section('page_css')
@endsection
@section('middle_content')
@if ($message = Session::get('success'))
        <div class="card-alert card green lighten-5">
                <div class="card-content green-text">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong  >{{ $message }}</strong>
                </div>
        </div>
        @endif
@if($errors->any())
      <div class="card-alert card red lighten-5 card-content red-text">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
<form action="{{route('store_coupon')}}" method="post" enctype="multipart/form-data" >
   @csrf
   
         <div class="row">
            <div class="input-name col s12">
               <input  name="coupon_Name" id="coupon_name" type="text" class="validate" placeholder="{{ __('Add coupon Name') }}">
               <label >{{ __('coupon Name') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="coupon_code" id="coupon_code" type="text" class="validate" placeholder="{{ __('Add coupon Code') }}">
               <label >{{ __('coupon code') }}</label>
            </div>
            
           <div class="input-price col s12">
               <input   name="value" id="price" type="number" step="0.5" min=".5" class="validate" placeholder="{{ __('Add Value') }}">
               <label  >{{ __('Value') }}</label>
            </div>

            <div class="coupon-type col s12 ">
               <select class="icons" name="type">
                        <option value="" disabled selected>{{ __('Choose your type') }}</option>
                        <option  value="fixed" name="type" class="circle"> {{ __('Fixed') }} </option>
                        <option  value="percentage" name="type" class="circle">{{ __('Percentage') }} </option>
               </select>
               <label>{{ __('coupon Type') }}</label>
            </div>

            <div class="coupon-status col s12 ">
               <select class="icons" name="status">
                        <option value="" disabled selected>{{ __('Choose your status') }}</option>
                        <option  value="active"   name="status" class="circle"> {{ __('Active') }}   </option>
                        <option  value="used"     name="status" class="circle"> {{ __('Used') }}     </option>
                        <option  value="expired"  name="status" class="circle"> {{ __('Expired') }}  </option>
                        <option  value="disabled" name="status" class="circle"> {{ __('Disabled') }} </option>
               </select>
               <label>{{ __('coupon status') }}</label>
            </div>

            <div class="input-unit col s12">
               <input  class="validate datepicker" name="coupon_date" id="coupon-unit" type="text" placeholder="{{ __('coupon date') }}">
               <label  >{{ __('coupon date') }}</label>
            </div>

            <div class="input-field col s12">
               <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                  <i class="material-icons right">send</i>
               </button>
            </div>
</form>
@section('page_js')
<script src="{{asset('resources/js/coupons-add.js')}}" type="text/javascript"></script>

@endsection
@endsection
