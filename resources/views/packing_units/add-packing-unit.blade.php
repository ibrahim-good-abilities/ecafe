@extends('layout')
@section('title', __('Add Packing Unit'))
@section('page_css')
@endsection
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('packing-units.index') }}">{{__('Back') }}
        <i class="material-icons right">keyboard_return</i>
    </a>
</div>
@endsection
@section('middle_content')
<div class="row">
    <div class="col s12">
        <!-- Point of sale make order screen -->
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
        @endif
        <form action="{{ route('packing-units.store') }}" method="post">
        @csrf
                    <div class="row">
                        <div class="col s12">

                            <div class="input-field col s12">
                                <input placeholder="{{ __('Enter Packing Unit Name') }}" id="name" type="text" class="validate" name="name">
                                <label for="first_name">{{ __('Packing Unit Name') }}</label>

                            </div>
                            <div class="input-name col s12">
                                <input  name="quantity" id="item_name" type="number" class="validate" placeholder="{{ __('Quantity') }}">
                                <label for="first_name">{{ __('Quantity') }}</label>
                             </div>
                        </div>

                        <div class="col s12">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                                <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
@section('page_js')
@endsection
@endsection
