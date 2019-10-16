@extends('layout')
@section('title', __('Settings'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/pages/page-contact.css')}}">
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
@if($errors->any())
      <div class="card-alert card red lighten-5 card-content red-text">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
<div id="contact-us" class="section">
    <div class="app-wrapper">
      <div id="sidebar-list" class="row contact-sidenav">

        <div class="contact-form margin-top-contact">
          <div class="row">
            <form class="col s12" action="{{route('store_setting')}}" method="post" enctype="multipart/form-data" >
              @csrf
              <div class="row">
                 <h6>{{__('Company name')}}</h6>
                <div class="input-field col m6 s12">
                  <input id="company_name" name="company_name" type="text" value="{{ $settings['company_name'] }}" class="validate">
                </div>


                <div class="col m6 s12 ">
                <h6 id="comapny_logo">{{__('Company logo')}}</h6>
                      <input id="upload_logo"  name ="upload_logo"type="file">
                </div>
              </div>

              <div class="row">
                  <h6>{{__('Company Phone')}}</h6>
                  <div class="input-field col m6 s12">
                    <input id="company_phone" name="company_phone" type="number" value="{{ $settings['company_phone'] }}" class="validate">
                  </div>
              </div>

                <div class="row">
                   <h6>{{__('Defualt TAX')}}</h6>
                    <div class="input-field col m6 s12">
                      <input id="defualt_tax"  name="defualt_tax" type="number" value="{{ $settings['defualt_tax'] }}" class="validate">
                    </div>
                </div>
                <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn cyan waves-effect waves-light right">
                                    {{ __('Edit') }}
                                    <i class="material-icons right">send</i>

                                </button>
                </div>
            </form>
          </div>
        </div>
      </div>
  </div>
 </div>


@section('page_js')
@endsection
@endsection
