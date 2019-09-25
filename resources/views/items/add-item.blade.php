@extends('layout')
@section('title', 'Add Item')
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
<form action="add" method="post" enctype="multipart/form-data" >
@csrf
<div class="card">
        <div class="card-content">
                 <div class="row">

              <div class="row">
                 <div class="input-name col s12">
                    <input  name="Item_Name" id="item_name" type="text" class="validate" placeholder="{{ __('Add Item Name') }}">
                    <label for="first_name">{{ __('Item Name') }}</label>
                 </div>
                 <div class="input-unit col s12">
                    <input  name="Item_unit" id="item-unit" type="number" class="validate" placeholder="{{ __('Add Item Unit') }}">
                    <label  >{{ __('Item Unit') }}</label>
                 </div>
              </div>
              <div class="row">
                 <div class="item-category col s12 ">
                    <select class="icons" name="category">
                    <option value="" disabled selected>{{ __('Choose your Category') }}</option>
                    <option value="1" data-icon="../../app-assets/images/avatar/avatar-7.png" name="category" class="circle">Category 1</option>
                    <option value="2" data-icon="../../app-assets/images/avatar/avatar-5.png" name="category" class="circle">Category 2</option>
                    <option value="3" data-icon="../../app-assets/images/avatar/avatar-3.png" name="category" class="circle">Category 3</option>
                    </select>
                    <label>{{ __('Item Category') }}</label>
                 </div>
                 </div>
                 </div>
                 <div class="row">
                 <div class="input-Checkbox col s12">
                          <label>{{ __('Has Stock') }}</label>
                       <p>
                          <label>
                          <input name="has_stock" type="radio" value="1" checked/>
                          <span>{{ __('yes') }}</span>
                          </label>
                       </p>
                       <p>
                          <label>
                          <input name="has_stock" type="radio"  value="0"/>
                          <span>{{ __('no') }}</span>
                          </label>
                       </p>
                 </div>
                 </div>
                 <div class="row">
                    <div class="input-alert col s12">
                          <input name="alert" id="alert-number" type="number" class="validate">
                          <label  >{{ __('Alert Number') }}</label>
                       </div>
                 </div>
                 <div class="row">
                    <div class="input-price col s12">
                          <input   name="price" id="price" type="number" class="validate">
                          <label  >{{ __('Price') }}</label>
                       </div>
                 </div>
                 <div class="row">
                    <div class="input-cost col s12">
                          <input  name="cost" id="cost" type="number" class="validate">
                          <label  >{{ __('Cost') }}</label>
                       </div>
                 </div>
                 <div class="row">
                 <div class="col s12 file-field input-field">
                 <div class="btn float-left">
                    <span>{{ __('Upload Image') }}</span>
                    <input type="file" name="image">
                 </div>
                 <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                 </div>
                 </div>
                 </div>

                 <div class="row">
                       <div class="input-field col s12">
                       <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                          <i class="material-icons right">send</i>
                       </button>
                       </div>
                    </div>

        </div>
                       </div>
              </div>
           </div>
</form>
@section('page_js')
@endsection
@endsection
