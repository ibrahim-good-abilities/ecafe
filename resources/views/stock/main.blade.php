@extends('layout')
@section('title', __('Main Stock'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/main_store.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">

@endsection
@section('middle_content')
  <table id="main_inventory_table" class="display">
    <thead>
      <tr>
          <th>صورة المنتج</th>
          <th>اسم المنتج</th>
          <th>الكميه</th>
          <th>العمليات</th>
          <th>الاعدادات</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
      <tr data-item_id="{{ $item->id }}">
          <td>
            <img src="{{asset('public'.$item->src)}}" class="item-image">
          </td>
          <td>{{$item->name}}</td>
          <td>{{$item->main_stock}}</td>
          <td class="left-align">
              <a class="modal-trigger" href="#transfer"><i class="material-icons" >autorenew</i></a>
              <a class="modal-trigger" href="#operations"><i class="material-icons">compare_arrows</i></a>
          </td>
          <td class="left-align">
              <a href="{{route('item_edit',['name'=>'main','id'=>$item->id])}}" ><i class="material-icons">edit</i></a>
              <a  href="{{route('item_delete',$item->id)}}"><i class="material-icons pink-text">cleare</i></a>
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>

<!-- Modal Structure -->
<div id="transfer" class="modal">
  <div class="modal-content">
    {{ Form::open(array('url' => 'foo/bar')) }}
      <h4>نقل مخزون</h4>
      <label for="contactNum" class="">أدخل الكميه: <span class="red-text">*</span></label>
      <input type="number" class="validate invalid" name="contactNum" id="contactNum" required="">
    {{ Form::close() }}
  </div>
  <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat"><h5>الغاء</h5></a>
      <a href="#!" class="modal-close waves-effect waves-green btn-flat"><h5>نقل</h5></a>
  </div>
</div>

<div id="operations" class="modal">
  <div class="modal-content">
    <h4>نوع العمليه</h4>
    <div class="row">
        <div class="input-field col m6 s6">
              <label for="contactNum" class="">أدخل الكميه: <span class="red-text">*</span></label>
              <input type="number" class="validate invalid" name="contactNum" id="contactNum" required="">
        </div>

        <div class="input-field col m6 s6">
          <select>
                <option value="" disabled selected>نوع العمليه</option>
                <option value="1">اضافه</option>
                <option value="2">اهلاك</option>
              
          </select>
        </div>
      </div>
     
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat"><h5>الغاء</h5></a>
          <a href="#!" class="modal-close waves-effect waves-green btn-flat"><h5>تنفيذ</h5></a>
        </div>
  </div>
</div>
  

                  <!-- main store -->

 @section('page_js')
 <script>
    var language = "{{asset('resources/json/Arabic.json')}}";
</script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/vendors/slick/slick.min.js')}}" type="text/javascript"></script>
 <script src="{{asset('resources/js/main_stock.js')}}" type="text/javascript"></script>
 @endsection
 @endsection

