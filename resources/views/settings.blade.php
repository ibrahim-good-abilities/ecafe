@extends('layout')
@section('title', __('settings'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/pages/page-contact.css')}}">
@endsection


@section('middle_content')



      
<div id="contact-us" class="section">
    <div class="app-wrapper">
      <div id="sidebar-list" class="row contact-sidenav">
      
        <div class="contact-form margin-top-contact">
          <div class="row">
            <form class="col s12">
              <div class="row">
                 <h6>Company name</h6>
                <div class="input-field col m6 s12">
                  <input id="company_name" type="text" class="validate">
                </div>

             
                <div class="col m6 s12 ">
                <h6 id="comapny_logo">Company logo</h6>
                  
                      <input id="upload_logo" type="file">
                    
                   
                </div>
              </div>

              <div class="row">
                  <h6>Company Phone</h6>
                  <div class="input-field col m6 s12">
                    <input id="company_phone" type="number" class="validate">
                  </div>
              </div>

                <div class="row">
                   <h6>Defualt TAX</h6>
                    <div class="input-field col m6 s12">
                    <input id="defualt_tax" type="number" class="validate">
                    </div>
                </div>

                <div class="input-field col s12 "> 
                  <a class="waves-effect waves-light btn">Send</a>
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