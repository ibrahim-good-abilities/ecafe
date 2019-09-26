@extends('layout')
@section('title', 'orders')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/pages/dashboard-modern.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/order-details.css')}}">

@endsection

@section('middle_content')
<div class="card-content">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <h5 class="card-title">{{__('Order Details')}}</h5>
            <form class="col s12">
                <div class="row">
                    <div class="input-field col m6 s12">
                        <h6>{{__('Order Id')}}: <span id="content">#20</span></h4>
                    </div>
                    <div class="input-field col m6 s12">
                        <h6>{{__('Customer Name')}} : <span id="content">mohamed</span></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <h6>{{__('Item Name')}} : <span id="content">cofe</span></h6>
                    </div>
                    <div class="input-field col m6 s12">
                        <h6>{{__('Date created')}} : <span id="content">Jan 1,2019</span></h6>
                    </div>
                </div>

            </form>



            <table class="subscription-table responsive-table highlight">
                <thead>
                    <tr>
                        <th>{{__('Quantity')}}</th>
                        <th>{{__('Price')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Sub Total')}}</th>
                        <th>{{__('Discount')}}</th>
                        <th>{{ __('Total') }}</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>250$</td>
                        <td>30$</td>
                        <td><span class="badge pink lighten-5 pink-text text-accent-2">Cancelled</span></td>
                        <td>280$</td>
                        <td>50%</td>
                        <td>140$</td>
                    </tr>

                    <tr>
                        <td>250$</td>
                        <td>30$.</td>
                        <td><span class="badge green lighten-5 green-text text-accent-4">Processing</span></td>
                        <td>280$</td>
                        <td>50%</td>
                        <td>140</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
        <!-- orders Details -->

        @endsection
