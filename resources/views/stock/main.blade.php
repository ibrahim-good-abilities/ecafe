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
<<<<<<< HEAD
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
  
                      <tr>
                          <td>
                            <img src="{{asset('public'.$item->src)}}" alt="avatar" class="item-image"> 
                           
                          </td>
                          <td>{{$item->name}}</td>
                          <td>{{$item->main_stock}}</td>
                          <td class="center-align">
                                    <a class=" modal-trigger"  href="#transfer"><i class="material-icons" >autorenew</i></a>
                                    <a class=" modal-trigger" href="#operations"><i class="material-icons">compare_arrows</i></a>
                                </td>
                          <td class="center-align">
                                    <a href="{{route('item_edit',['name'=>'main','id'=>$item->id])}}" ><i class="material-icons">edit</i></a>
                                    <a class="delete-with-confirmation"  href="{{route('item_delete',$item->id)}}"><i class="material-icons pink-text">clear</i></a>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
=======
  <!-- Point of sale make order screen -->
  @if($errors->any())
      <div class="card-alert card red lighten-5 card-content red-text">
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
  @endif
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
  @elseif ($message = Session::get('error'))
    <div class="card-alert card gradient-45deg-red-pink">
      <div class="card-content white-text">
        <p>
          <i class="material-icons">error</i> {{ $message }}</p>
      </div>
      <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  @endif
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
              <a class="modal-trigger" href="#transfer"><i class="material-icons" >compare_arrows</i></a>
              <a class="modal-trigger" href="#operations"><i class="material-icons">autorenew</i></a>
          </td>
          <td class="left-align">
              <a href="{{route('item_edit',['name'=>'main','id'=>$item->id])}}" ><i class="material-icons">edit</i></a>
              <a  href="{{route('item_delete',$item->id)}}" class="delete-with-confirmation"><i class="material-icons pink-text">cleare</i></a>
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
>>>>>>> 15fdcb54a2fa8ba74431247b9f7965ad0da1d481

<!-- Modal Structure -->
<div id="transfer" class="modal">
  <form action="{{ route('transfer_main_stock') }}" method="post">
    @csrf
    <div class="modal-content">
        <h4>نقل مخزون</h4>
        <label for="quantity" class="">أدخل الكميه</label>
        <input type="number" class="validate" name="quantity" id="quantity" required="">
        <input type="hidden" name="item_id" value=""/>
    </div>
    <div class="modal-footer">
<<<<<<< HEAD
      <div class="button-wrapper">
        <a class="modal-close btn red waves-effect waves-light right">{{ __('Cancel') }}
          <i class="material-icons right">cancel</i>
        </a>
      </div>
      <div class="button-wrapper">
        <button class="btn cyan waves-effect waves-light right" type="submit">{{ __('Transfer') }}
          <i class="material-icons right">send</i>
        </button>
      </div>
=======
         <a href="#!" class="modal-close waves-effect waves-green btn-flat "><h5>الغاء</h5></a>
      <a href="#!" class="modal-close waves-effect waves-green btn-flat"><h5>نقل</h5></a>
    
>>>>>>> 860ffd755a57819b882201d77ff4144216304622
    </div>
  </form>
</div>

<div id="operations" class="modal">
  <form action="{{ route('main_stock_operations') }}" method="post">
    @csrf
    <div class="modal-content">
      <h4>{{ __('Execute An Operation') }}</h4>
      <div class="row">
          <div class="input-field col m6 s6">
                <label for="quantity" class="">أدخل الكميه</label>
                <input type="number" name="quantity" id="quantity" required="">
          </div>

          <div class="input-field col m6 s6">
            <select name="operation">
                  <option value="" disabled selected>نوع العمليه</option>
                  <option value="1">اضافه</option>
                  <option value="2">اهلاك</option>
                
            </select>
            <input type="hidden" name="item_id" value=""/>
          </div>
        </div>
        
        <div class="modal-footer">
          <div class="button-wrapper">
            <a class="modal-close btn red waves-effect waves-light right">{{ __('Cancel') }}
              <i class="material-icons right">cancel</i>
            </a>
          </div>
          <div class="button-wrapper">
            <button class="btn cyan waves-effect waves-light right" type="submit">{{ __('Execute') }}
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
    </div>
  </form>
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

