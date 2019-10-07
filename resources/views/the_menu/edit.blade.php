@extends('layout')
@section('title', __('Edit Item'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/edite-blade.css')}}">
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
<form action="{{ route('menu_item_update',$item->id) }}" method="post" enctype="multipart/form-data" >
   @csrf
         <div class="row">
            <div class="input-name col s12">
               <input  name="item_name" id="item_name" type="text" class="validate" placeholder="{{ __('Add Item Name') }}"value="{{$item->name}}">
               <label for="item_name">{{ __('Item Name') }}</label>
            </div>

            <div class="item-category col s12 ">
               <select class="icons" name="category">
                  <option value="" disabled selected>{{ __('Choose your Category') }}</option>
                  @foreach($categories_name as $category)
                        <option  value="{{$category->id}}"  name="category" class="circle"  {{ $category->id == $item->category_id ? 'selected':''}} > {{$category->category_name}} </option>
                  @endforeach
               </select>
               <label>{{ __('Item Category') }}</label>
            </div>

            <div class="input-price col s12">
               <input name="price" id="price" type="number" class="validate" placeholder="{{ __('Add Price') }}"value="{{$item->price}}">
               <label  >{{ __('Price') }}</label>
            </div>

            <div class="col s12 file-field input-field">
                  <div class="row">
                        <div class ="col s6 ">
                                 <img src="{{asset('public'.$item->src)}}" class="" style="max-width: 100px">
                        </div>
                        <div class="btn float-left col s2">
                           <span>{{ __('Change Image') }}</span>
                           <input type="file" name="image">
                        </div>
                       
                  <div>      
            </div>

            <div class="input-field col s12">
               <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                  <i class="material-icons right">send</i>
               </button>
            </div>
         </div>
    
</form>
@section('page_js')
@endsection
@endsection