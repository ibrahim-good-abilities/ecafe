@extends('layout')
@section('title', 'Add Item')
@section('page_css')
@endsection
@section('middle_content')
@if ($message = Session::get('success'))
<div class="card-alert card green lighten-5">
        <div class="card-content black-text">
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
                    <input placeholder="Item_Name" id="item_name" type="text" class="validate">
                    <label for="first_name">Item Name</label>
                 </div>
                 <div class="input-unit col s12">
                    <input placeholder="Item_Unit" id="item-unit" type="number" class="validate">
                    <label  >Item Unit</label>
                 </div>
              </div>
              <div class="row">
                 <div class="item-category col s12 ">
                    <select class="icons" name="category">
                    <option value="" disabled selected>Choose your Category</option>
                    <option value="" data-icon="../../app-assets/images/avatar/avatar-7.png" class="circle">Category 1</option>
                    <option value="" data-icon="../../app-assets/images/avatar/avatar-5.png" class="circle">Category 2</option>
                    <option value="" data-icon="../../app-assets/images/avatar/avatar-3.png" class="circle">Category 3</option>
                    </select>
                    <label>Item Category</label>
                 </div>
                 </div>
                 </div>
                 <div class="row">
                 <div class="input-Checkbox col s12">
                          <label>Has Stock</label>
                       <p>
                          <label>
                          <input name="has_stock" type="radio" checked/>
                          <span>yes</span>
                          </label>
                       </p>
                       <p>
                          <label>
                          <input name="has_stock" type="radio" />
                          <span>no</span>
                          </label>
                       </p>
                 </div>
                 </div>
                 <div class="row">
                    <div class="input-alert col s12">
                          <input placeholder="Alert Number" name="alert" id="alert-number" type="number" class="validate">
                          <label  >Alert Number</label>
                       </div>
                 </div>
                 <div class="row">
                    <div class="input-price col s12">
                          <input placeholder="Price"  name="price" id="price" type="number" class="validate">
                          <label  >Price</label>
                       </div>
                 </div>
                 <div class="row">
                    <div class="input-cost col s12">
                          <input placeholder="Cost" name="cost" id="cost" type="number" class="validate">
                          <label  >Cost</label>
                       </div>
                 </div>
                 <div class="row">
                 <div class="col s12 file-field input-field">
                 <div class="btn float-right">
                    <span>Image</span>
                    <input type="file" name="image">
                 </div>
                 <div class="file-path-wrapper">
                    <input placeholder="Add Image" class="file-path validate" type="text">
                 </div>
                 </div>
                 </div>

                 <div class="row">
                       <div class="input-field col s12">
                       <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
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
