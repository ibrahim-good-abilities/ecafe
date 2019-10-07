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
<form action="{{ route('item_update',$item->id) }}" method="post" enctype="multipart/form-data" >
   @csrf
         <div class="row">
            <div class="input-name col s12">
               <input  name="Item_Name" id="item_name" type="text" class="validate" placeholder="{{ __('Add Item Name') }}"value="{{$item->name}}">
               <label for="first_name">{{ __('Item Name') }}</label>
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
               <input   name="price" id="price" type="number" class="validate" placeholder="{{ __('Add Price') }}"value="{{$item->price}}">
               <label  >{{ __('Price') }}</label>
            </div>

            <div class="input-cost col s12">
                  <input  name="cost" id="cost" type="number" class="validate" placeholder="{{ __('Add Cost') }}"value="{{$item->cost}}">
                  <label  >{{ __('Cost') }}</label>
            </div>
            
            @if($type == 'main')
            <div class="input-cost col s12">
                  <input  name="quantity" id="cost" type="number"  step="0.1" min=".5" class="validate" 
                  placeholder="{{ __('Add quantity') }}" value="{{$item->main_stock}}">
                  <label  >{{ __('Quantity') }}</label>
            </div>
            @else
               <input  name="quantity"  type="hidden"  value="{{$item->main_stock}}"/>
            @endif

            <div class="item-packing-unit col s12 ">
               <select class="icons" name="packing_unit">
                  <option value="" disabled>{{ __('Choose a packing unit') }}</option>
                  @foreach($packing_units as $packing_unit)
                        <option  value="{{ $packing_unit->id }}" class="circle" {{ $packing_unit->id == $item->packing_unit_id ? 'selected':''}}> {{$packing_unit->name}} </option>
                  @endforeach
               </select>
               <label>{{ __('Packing Unit') }}</label>
            </div>

            <div class="input-alert col s12">
               <input name="alert" id="alert-number" type="number" class="validate" placeholder="{{ __('Add Alert Number') }}"value="{{$item->alert_number}}">
               <label  >{{ __('Alert Number') }}</label>
            </div>
            <div class="col s12 file-field input-field">
                  <div class="row">
                        <div class ="col s6 ">
                                 <img id="output" src="{{asset('public'.$item->src)}}" class="" style="max-width: 100px">
                        </div>
                        <div class="btn float-left col s2">
                           <span>{{ __('Change Image') }}</span>
                           <input type="file" name="image" class="upload-preview" >
                        </div>
                       
                  <div>      
            </div>

            <div class="input-field col s12">
               <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                  <i class="material-icons right">send</i>
               </button>
            </div>

            <div class="col s12 m12 l12">


      <div id="inline-form" class="card card card-default scrollspy">
        <div class="card-content">
               <h4 class="card-title">مكونات المنتج</h4>
          <form class="col s12">
            <div class="row">
                  <div class="input-field col m4 s12">
                        <button class="btn cyan waves-effect waves-light" type="submit" name="action">
                        <i class="material-icons left">add</i>اضافه</button>
                  </div>
                  <div class="input-field col m4 s6">
                  <input  name="cost" id="cost" type="number" class="validate" placeholder="{{ __('Add Cost') }}"value="{{$item->cost}}">
                        <label  >ادخل الكميه</label>
                  </div>
                  <div class="input-field col m4 s6">
                  <select class="icons" name="">
                  <option value="" disabled selected> add new</option>
                        <option value="" >normal</option>
                        <option value="" >spectial</option>
                     </select>
                     <label>اختار المكون</label>
                  </div>   
            </div>
          </form>

         <table>
            <thead>
               <tr>
                     <th>صوره المنتج</th>
                     <th>اسم المنتج</th>
                     <th>حذف</th>

               </tr>
            </thead>

            <tbody>
            
               <tr>
                     <td><img src="http://localhost/ecafe/public/images/items/1570435507.jpg" class="item-image" ></td>
                     <td>الاسم</td>
                  
                     <td>
                        <a class="delete-with-confirmation" href="{{route('item_delete',$item->id)}}">
                           <i class="material-icons pink-text">clear</i>
                        </a>
                     </td>
               </tr>

            </tbody>
         </table>

    </div>
</div>
@section('page_js')
<script src="{{asset('resources/js/custom/custom-script.js')}}" type="text/javascript"></script>
@endsection
@endsection
