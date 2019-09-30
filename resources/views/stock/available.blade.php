@extends('layout')
@section('title', 'available stock')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/items.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">

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
<div class="row">
    <div class="col s12">
        <h4 class="card-title">{{ __('available stock') }} </h4>
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
                    <th> الاعدادات</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><img src="{{asset('public'.$item->src)}}" class="circle" style="max-width: 55px"></td>

                    <td>{{ $item->name}}</td>
                    <td>{{ $item->unit}}</td>
                    <td> {{ $item->category_name}}</td>
                    <td>{{$item->available_stock}}</td>
                    <td>{{ $item->alert_number}}</td>
                    <td>${{ $item->price}}</td>
                    <td>${{ $item->cost}}</td>
                    <td>
                        <a class="btn-floating mb-1 btn-flat waves-effect waves-light pink accent-2 white-text" href="{{route('item_edit',['name'=>'available','id'=>$item->id])}}">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn-floating mb-1 waves-effect waves-light " href="{{route('item_delete',$item->id)}}">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@section('page_js')
<script src="{{asset('resources/js/scripts/data-tables.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
@endsection
@endsection
