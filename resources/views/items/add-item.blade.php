@extends('layout')
@section('title',  __('Add Item'))
@section('page_css')
@endsection

@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('items_index') }}">{{__('Back') }}
        <i class="material-icons right">keyboard_return</i>
    </a>
</div>
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
@if($errors->any())
      <div class="card-alert card red lighten-5 card-content red-text">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
<form action="add" method="post" enctype="multipart/form-data" >
   @csrf
   
         <div class="row">
            <div class="input-name col s12">
               <input  name="Item_Name" id="item_name" type="text" class="validate" placeholder="{{ __('Add Item Name') }}">
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
               <input  name="Item_unit" id="item-unit" type="text" class="validate" placeholder="{{ __('Add Item Unit') }}">
               <label  >{{ __('Item Unit') }}</label>
            </div>



            <div class="input-price col s12">
               <input   name="price" id="price" type="number" step="0.5" min=".5" class="validate" placeholder="{{ __('Add Price') }}">
               <label  >{{ __('Price') }}</label>
            </div>

            <div class="input-cost col s12">
                  <input  name="cost" id="cost" type="number"  step="0.5" min=".5" class="validate" placeholder="{{ __('Add Cost') }}">
                  <label  >{{ __('Cost') }}</label>
            </div>
            <div class="input-cost col s12">
                  <input  name="quantity" id="cost" type="number"  step="0.1" min=".5" class="validate" placeholder="{{ __('Add Quantity') }}">
                  <label  >{{ __('Quantity') }}</label>
            </div>
       

            <div class="input-alert col s12">
               <input name="alert" id="alert-number" type="number" class="validate" placeholder="{{ __('Add Alert Number') }}">
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
         
     
</form>
@section('page_js')
@endsection
@endsection
