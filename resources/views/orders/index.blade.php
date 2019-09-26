@extends('layout')
@section('title', 'orders')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/pages/dashboard-modern.css')}}">

@endsection
@section('middle_content')
<!-- orders table -->

        <div class="card subscriber-list-card animate fadeRight">
            <div class="card-content pb-1">

                <h4 class="card-title mb-0">{{ __('order list') }} <i class="material-icons float-right">more_vert</i></h4>
            </div>
            <table class="subscription-table responsive-table highlight">
                <thead>
                    <tr>
                        <th>{{ __(' Order Id') }}</th>
                        <th>{{ __(' Customer Name') }}</th>
                        <th> {{ __('Date Created') }}</th>
                        <th>{{ __('Status ') }}</th>
                        <th> {{ __('Total ') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#25</td>
                        <td>ABC Fintech LTD.</td>
                        <td>Jan 1,2019</td>
                        <td><span class="badge pink lighten-5 pink-text text-accent-2">Cancelled</span></td>
                        <td>200000</td>
                        <td class="center-align"><a href="#"><i class="material-icons pink-text">clear</i></a>
                            <a href="{{route('edit_order')}}"><i class="material-icons dp48">visibility</i></a>
                        </td>
                    </tr>

                    <tr>
                        <td>#27</td>
                        <td>Collboy Tech LTD.</td>
                        <td>Jan 12,2019</td>
                        <td><span class="badge green lighten-5 green-text text-accent-4">Processing</span></td>
                        <td>300000</td>
                        <td class="center-align"><a href="#"><i class="material-icons pink-text">clear</i></a>
                            <a href="#"><i class="material-icons dp48">visibility</i></a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>


        <!-- orders table -->
        @endsection
