@extends('layout')
@section('title', 'قائمة الاصناف')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/category.css')}}">
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
        <table id="category-table" class="subscription-table responsive-table highlight">
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
                    <td><img src="{{asset('public'.$category->src)}}" class="item-image"></td>
                    <td>{{ $category->category_name}}</td>
                    <td class="left-align">
                        <a href="{{route('edit_category',$category->id)}}"><i class="material-icons">create</i></a>
                        <a class="delete-with-confirmation" href="{{ route('delete_category',$category->id) }}"><i class="material-icons pink-text">clear</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@section('page_js')
<script src="{{asset('resources/js/category.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
@endsection
@endsection
