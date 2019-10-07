@extends('layout')
@section('title', __('Packing Units'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
@endsection
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('packing-units.create') }}">{{__('Add New') }}
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
        <table id="packing-units-table" class="subscription-table responsive-table highlight">
            <thead>
                <tr>
                    <th>{{ __('Packing Unit') }}</th>
                    <th>{{__('Quantity')}}</th>
                    <th>{{ __('Settings') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                <tr>
                    <td>{{ $unit->name}}</td>
                    <td>{{$unit->quantity}}</td>
                    <td class="left-align">
                        <a href="{{route('packing-units.edit',$unit->id)}}"><i class="material-icons">create</i></a>
                        <a class="delete-with-confirmation" href="{{ route('packing_unit_delete',$unit->id) }}"><i class="material-icons pink-text">clear</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@section('page_js')
<script src="{{asset('resources/js/packing-units.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
@endsection
@endsection
