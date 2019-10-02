@extends('layout')
@section('title', __('Coupons'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/coupons.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
@endsection
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('add_coupon') }}">{{__('ADD NEW') }}
        <i class="material-icons right">add</i>
    </a>
</div>
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

        <table id="coupons" class="display">
            <thead>
                <tr>
                    <th>اسم الكوبون</th>
                    <th>كود الكوبون</th>
                    <th> القيمة</th>
                    <th>النوع</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->name}}</td>
                    <td>{{ $coupon->code}}</td>
                    <td>{{$coupon->value}}</td>
                    <td>{{ $coupon->type}}</td>
                    <td>{{ $coupon->status}}</td>
                    <td class="center-align">
                        <a  href="{{route('coupon_edit',$coupon->id)}}">
                            <i class="material-icons">edit</i>
                        </a>
                        <a  class="delete-with-confirmation" href="{{route('coupon_delete',$coupon->id)}}">
                            <i class="material-icons pink-text delete-with-confirmation">clear</i>
                        </a>
                         <a>
                         <i class="material-icons">not_interested</i>
                         </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
  

@section('page_js')
<script src="{{asset('resources/js/coupons.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
@endsection
@endsection
