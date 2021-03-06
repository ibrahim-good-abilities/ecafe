@extends('layout')
@section('title',  __('Edit Coupon'))
@section('page_css')
@endsection
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
@if($errors->any())
      <div class="card-alert card red lighten-5 card-content red-text">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('coupons') }}">{{__('Back') }}
        <i class="material-icons right">keyboard_return</i>
    </a>
</div>

@endsection
@section('middle_content')
<form action="{{route('update_coupon',$coupon->id)}}" method="post" enctype="multipart/form-data" >
   @csrf

         <div class="row">
            <div class="input-name col s12">
               <input  name="coupon_Name" id="coupon_name" type="text" class="validate" placeholder="{{ __('Add coupon Name') }}" value="{{$coupon->name}}">
               <label >{{ __('Coupon Name') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="coupon_code" id="coupon_code" type="text" class="validate" placeholder="{{ __('Add coupon Code') }}" value="{{$coupon->code}}">
               <label >{{ __('Coupon Code') }}</label>
            </div>

           <div class="input-price col s12">
               <input   name="value" id="price" type="number" step="0.5" min=".5" class="validate" placeholder="{{ __('Add Value') }} " value="{{number_format($coupon->value,2)}}">
               <label  >{{ __('Value') }}</label>
            </div>

            <div class="coupon-type col s12 ">
               <select class="icons" name="type" value=>
                        <option value="" disabled >{{ __('Choose Your Type') }}</option>
                        <option  value="fixed" name="type" class="circle" {{$coupon->type=='fixed'?'selected':''}}> {{ __('Fixed') }} </option>
                        <option  value="percentage" name="type" class="circle"{{$coupon->type=='percentage'?'selected':''}}> {{ __('Percentage') }} </option>
               </select>
               <label>{{ __('Coupon Type') }}</label>
            </div>

            <div class="coupon-status col s12 ">
               <select class="icons" name="status">
                        <option value="" disabled  >{{ __('Choose Your Status') }}</option>
                        <option  value="active" name="status" class="circle" {{$coupon->status=='active'?'selected':''}}> {{ __('Active') }} </option>
                        <option  value="used" name="status" class="circle" {{$coupon->status=='used'?'selected':''}}> {{ __('Used') }}  </option>
                        <option  value="expired"  name="status" class="circle" {{$coupon->status=='expired'?'selected':''}}> {{ __('Expired') }}  </option>
                        <option  value="disabled" name="status" class="circle"{{$coupon->status=='disabled'?'selected': ''}}> {{ __('Disabled') }} </option>
               </select>
               <label>{{ __('Coupon Status') }}</label>
            </div>

            <div class="input-unit col s12">
               <input  class="validate datepicker" name="coupon_date" id="coupon-unit" type="text" placeholder="{{ __('coupon date') }}" value="{{$coupon->expiry_date}}">
               <label  >{{ __('Coupon Date') }}</label>
            </div>

            <div class="input-field col s12">
               <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Edit') }}
                  <i class="material-icons right">send</i>
               </button>
            </div>
</form>
@section('page_js')
<script src="{{asset('resources/js/coupons-add.js')}}" type="text/javascript"></script>

@endsection
@endsection
