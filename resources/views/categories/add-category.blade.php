@extends('layout')
@section('title', __('Add Category'))
@section('page_css')
@endsection
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('all_categories') }}">{{__('Back') }}
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
        <div class="card-alert card green lighten-5">
                <div class="card-content green-text">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong  >{{ $message }}</strong>
                </div>
        </div>
        @endif
        <form action="store" method="post" enctype="multipart/form-data">
        @csrf
                    <div class="row">
                        <div class="col s12">

                            <div class="input-field">
                                <input placeholder="{{ __('Add Category Name') }}" id="first_name" type="text" class="validate" name="category_name">
                                <label for="first_name">{{ __('Category Name') }}</label>

                            </div>
                        </div>

                        <div class="col s12">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>{{ __('Upload Image') }}</span>
                                    <input type="file" name="img">
                                    <span></span>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
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
