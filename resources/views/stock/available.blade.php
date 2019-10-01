@extends('layout')
@section('title', __('Available Stock'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/items.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">

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

        <table id="data-table-simple" class="display">
            <thead>
                <tr>
                    <th>صوره المنتج</th>
                    <th>اسم المنتج</th>
                    <th>فئه المنتج</th>
                    <th>وحده المنتج</th>
                    <th>كمية المنتج</th>
                    <th>رقم التنبيه</th>
                    <th>السعر</th>
                    <th>التكلفه</th>
                    <th>العمليات</th>
                    <th> الاعدادات</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><img src="{{asset('public'.$item->src)}}" class="item-image" ></td>

                    <td>{{ $item->name}}</td>
                    <td>{{ $item->unit}}</td>
                    <td> {{ $item->category_name}}</td>
                    <td>{{$item->available_stock}}</td>
                    <td>{{ $item->alert_number}}</td>
                    <td>${{ $item->price}}</td>
                    <td>${{ $item->cost}}</td>
                    <td class="left-align">
              <a class="modal-trigger" href="#transfer"><i class="material-icons" >compare_arrows</i></a>
              <a class="modal-trigger" href="#operations"><i class="material-icons">autorenew</i></a>
          </td>
                    <td class="center-align">
                        <a  href="{{route('item_edit',['name'=>'available','id'=>$item->id])}}">
                            <i class="material-icons">edit</i>
                        </a>
                        <a   class="delete-with-confirmation" href="{{route('item_delete',$item->id)}}">
                            <i class="material-icons pink-text">clear</i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
<div id="transfer" class="modal">
  <form action="{{ route('transfer_availbale_stock') }}" method="post">
    @csrf
    <div class="modal-content">
        <h4>نقل مخزون</h4>
        <label for="quantity" class="">أدخل الكميه</label>
        <input type="number" class="validate" name="quantity" id="quantity" required="">
        <input type="hidden" name="item_id" value=""/>
    </div>
    <div class="modal-footer">
         <a href="#!" class="modal-close waves-effect waves-green btn-flat "><h5>الغاء</h5></a>
      <a href="#!" class="modal-close waves-effect waves-green btn-flat"><h5>نقل</h5></a>
    
    </div>
  </form>
</div>

<div id="operations" class="modal">
  <form action="{{ route('available_stock_operations') }}" method="post">
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
  
  

@section('page_js')
<script src="{{asset('resources/js/scripts/data-tables.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
@endsection
@endsection
