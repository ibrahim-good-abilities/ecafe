@extends('layout')
@section('title', __('Menu Items'))
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

<table id="menu_items" class="display">
    <thead>
        <tr>
            <th>{{ __('Item Image') }}</th>
            <th>{{ __('Item Name') }}</th>
            <th>{{ __('Item Category') }}</th>
            <th>{{ __('Item Price') }}</th>
            <th>{{ __('Settings') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr data-item_id="{{ $item->id }}">
            <td><img src="{{asset('public'.$item->src)}}" class="item-image" ></td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->category_name }}</td>
            <td>{{ $item->price }}</td>
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
        

@section('page_js')
<script src="{{asset('resources/js/scripts/data-tables.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/js/menu_items.js')}}" type="text/javascript"></script>
@endsection
@endsection
