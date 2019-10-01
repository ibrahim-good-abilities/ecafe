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
                    <td class="center-align">
                                    <a class=" modal-trigger"  href="#transfer"><i class="material-icons" >autorenew</i></a>
                                    <a class=" modal-trigger" href="#operations"><i class="material-icons">compare_arrows</i></a>
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
  

@section('page_js')
<script src="{{asset('resources/js/scripts/data-tables.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
@endsection
@endsection
