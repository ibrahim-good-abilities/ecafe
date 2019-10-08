@extends('layout')
@section('title', __('Available Stock'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/items.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">

@endsection
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('add_item') }}">{{__('Add New') }}
        <i class="material-icons right">add</i>
    </a>
</div>
@endsection
@section('middle_content')
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

<table id="main_inventory_table" class="subscription-table highlight">
    <thead>
        <tr>
            <th>صوره المنتج</th>
            <th>اسم المنتج</th>
            <th>فئه المنتج</th>
            <th>كمية المنتج</th>
            <th>العمليات</th>
            <th> الاعدادات</th>

        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr data-item_id="{{ $item->id }}">
            <td><img src="{{asset('public'.$item->src)}}" class="item-image" ></td>
            <td>{{ $item->name}}</td>
            <td>{{ $item->category_name}}</td>
            <td>{{$item->available_stock}}</td>
            <td class="left-align">
              <a class="modal-trigger" href="#transfer"><i class="material-icons" >compare_arrows</i></a>
              <a class="modal-trigger" href="#operations"><i class="material-icons">autorenew</i></a>
            </td>
            <td class="center-align">
                <a  href="{{route('item_edit',['name'=>'available','id'=>$item->id])}}">
                    <i class="material-icons">edit</i>
                </a>
                <a class="delete-with-confirmation" href="{{route('item_delete',$item->id)}}">
                    <i class="material-icons pink-text">clear</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="transfer" class="modal">
  <form action="{{ route('transfer_available_stock') }}" method="post">
    @csrf
    <div class="modal-content">
        <h4>نقل مخزون</h4>
        <label for="quantity" class="">أدخل الكميه</label>
        <input type="number" class="validate" name="quantity" id="quantity" required="">
        <input type="hidden" name="item_id" value=""/>
    </div>
    <div class="modal-footer">
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
    </div>
  </form>
</div>

<div id="operations" class="modal">
  <form action="{{ route('available_stock_operations') }}" method="post">
    @csrf
    <div class="modal-content">
      <h4>{{ __('Execute An Operation') }}</h4>
      <div class="row">
          <div class="input-field col m4 s6">
                <label for="quantity" class="">أدخل الكميه</label>
                <input type="number" name="quantity" id="quantity" required="">
          </div>
          <div class="input-field col m4 s6">
            <select name="packing_unit">
                  <option value="" disabled selected>وحده التعبئه</option>
                  <option value="0">بدون</option>
                  @foreach  ($packing_units as $packing_unit)
                  <option value="{{$packing_unit->id}}">{{$packing_unit->name}}</option>
                  @endforeach
            </select>
          </div>

          <div class="input-field col m4 s6">
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



@section('page_js')
<script src="{{asset('resources/js/scripts/data-tables.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/js/available_stock.js')}}" type="text/javascript"></script>
@endsection
@endsection
