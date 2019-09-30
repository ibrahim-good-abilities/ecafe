@extends('layout')
@section('title', __('Edit Item'))
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
<form action="{{ route('item_update',$item->id) }}" method="post" enctype="multipart/form-data" >
   @csrf
   <div class="card">
      <div class="card-content">
         <h4 class="card-title">{{ __('Edit Item') }}</h4>
         <div class="row">
            <div class="input-name col s12">
               <input  name="Item_Name" id="item_name" type="text" class="validate" placeholder="{{ __('Add Item Name') }}"value="{{$item->name}}">
               <label for="first_name">{{ __('Item Name') }}</label>
            </div>

            <div class="item-category col s12 ">
               <select class="icons" name="category">
                  <option value="" disabled selected>{{ __('Choose your Category') }}</option>
                  @foreach($categories_name as $category_name)
                        <option  value="{{$category_name->id}}" data-icon="../../app-assets/images/avatar/avatar-7.png" name="category" class="circle"> {{$category_name->category_name}} </option>
                  @endforeach
               </select>
               <label>{{ __('Item Category') }}</label>
            </div>
            <div class="input-unit col s12">
               <input  name="Item_unit" id="item-unit" type="text" class="validate" placeholder="{{ __('Add Item Unit') }}"  value="{{$item->unit}}">
               <label  >{{ __('Item Unit') }}</label>
            </div>
            



            <div class="input-price col s12">
               <input   name="price" id="price" type="number" class="validate" placeholder="{{ __('Add Price') }}"value="{{$item->price}}">
               <label  >{{ __('Price') }}</label>
            </div>

            <div class="input-cost col s12">
                  <input  name="cost" id="cost" type="number" class="validate" placeholder="{{ __('Add Cost') }}"value="{{$item->cost}}">
                  <label  >{{ __('Cost') }}</label>
            </div>

            <div class="input-cost col s12">
                  <input  name="quantity" id="cost" type="number"  step="0.1" min=".5" class="validate" 
                  placeholder="{{ __('Add quantity') }}" value="{{$type=='available'?$item->available_stock:$item->main_stock}}">
                  <label  >{{ __('quantity') }}</label>
            </div>

            <div class="input-Checkbox col s12">
               <label>{{ __('Stock') }}</label>
               <p>
                  <label>
                     <input name="stock" type="radio" value="main" checked/>
                     <span>{{ __('main stock') }}</span>
                  </label>
                  <label>
                     <input name="stock" type="radio"  value="available "/>
                     <span>{{ __('available stock') }}</span>
                  </label>
               </p>
            </div>
            <div class="input-alert col s12">
               <input name="alert" id="alert-number" type="number" class="validate" placeholder="{{ __('Add Alert Number') }}"
               value="{{$item->alert_number}}">
               <label  >{{ __('Alert Number') }}</label>
            </div>
            
            <div class="col s12 file-field input-field">
               <div class="btn float-left">
                  <span>{{ __('Upload Image') }}</span>
                  <input type="file" name="image">
               </div>
               <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
               </div>
            </div>

            <div class="input-field col s12">
               <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                  <i class="material-icons right">send</i>
               </button>
            </div>
         </div>
      </div>
   </div>
</form>
@section('page_js')
@endsection
@endsection
