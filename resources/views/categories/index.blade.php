@extends('layout')
@section('title', 'قائمة الاصناف')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/items.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
@endsection
@section('middle_content')
@if ($message = Session::get('success'))
<div class="card-alert card green lighten-5">
    <div class="card-content green-text">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif
        <table id="data-table-simple" class="display">
            <thead>
                <tr>
                    <th>صوره المنتج</th>
                    <th> اسم المنتج </th>
                    <th> الأعدادات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td><img src="{{asset('public'.$category->src)}}" class="circle" style="max-width: 55px"></td>
                    <td>{{ $category->category_name}}</td>
                    <td>
                        <a class="btn-floating mb-1 btn-flat waves-effect waves-light pink accent-2 white-text" href="{{route('edit_category',$category->id)}}">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn-floating mb-1 waves-effect waves-light " href="{{route('delete_category',$category->id)}}">
                            <i class="material-icons">delete</i>
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
