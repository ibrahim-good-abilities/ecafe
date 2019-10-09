@extends('layout')
@section('title', __('Edit Item'))
@section('page_css')
@endsection

@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('menu') }}">{{__('Back') }}
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
                                 <img id="output" src="{{asset('public'.$item->src)}}" class="" style="max-width: 100px">
                        </div>
                        <div class="btn float-left col s2">
                           <span>{{ __('Change Image') }}</span>
                           <input type="file" name="image" accept="image/*" class="upload-preview">
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

<div id="inline-form" class="card card card-default scrollspy">
    <div class="card-content">
       <h4 class="card-title">مكونات المنتج</h4>
       <form action="{{route('ingredients.store')}}" method="post"  class="col s12">
           @csrf
           <input type="hidden" name="main_item_id" value="{{ $item->id }}"/>
          <div class="row">
             <div class="input-field col m4 s12">
                   <button class="btn cyan waves-effect waves-light" type="submit" name="action">
                   <i class="material-icons left">add</i>اضافه</button>
             </div>
             <div class="input-field col m4 s6">
                <input  name="quantity" id="quantity" type="number" class="validate" placeholder="{{ __('Add Quantity') }}"value="{{$item->quantity}}">
                <label  >ادخل الكميه</label>
             </div>
             <div class="input-field col m4 s6">
                <select class="icons" name="sub_item_id">
                <option value="" disabled selected>{{ __("Select")}}</option>

                    @foreach($items_is_menu_zero as $item_is_menu_zero)
                      <option value="{{ $item_is_menu_zero->id }}" >{{$item_is_menu_zero->name}}</option>
                    @endforeach
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
                <th>الكميه</th>
                <th>حذف</th>
             </tr>
          </thead>

          <tbody>
              @foreach($ingredient_items as $ingredient_item)
             <tr>
                <td><img src="{{asset('public'.$ingredient_item->src)}}" class="item-image" ></td>
                <td>{{$ingredient_item->name}}</td>
                <td>{{$ingredient_item->quantity}}</td>
                <td>
                   <a class="delete-with-confirmation" href="{{route('ingredient_delete',$ingredient_item->id)}}">
                      <i class="material-icons pink-text">clear</i>
                   </a>
                </td>
             </tr>
             @endforeach
          </tbody>
       </table>
    </div>
 </div>
@section('page_js')
@endsection
@endsection
