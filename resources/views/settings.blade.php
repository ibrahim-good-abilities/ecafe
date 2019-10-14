@extends('parista-layout')
@section('title', __('settings'))
@section('page_css')

@endsection


@section('middle_content')




<div>
<h2>Settings</h2>

<p>Update Your Settings </p>
</div>


<div class="contact-form margin-top-contact">
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col m6 s12">
              <h6>company name</h6>
                <input id="name" type="text" class="validate">
      
              </div>
              <div class="input-field col m6 s12">
                 <h6>company phone</h6>
                <input id="phone" type="text" class="validate">
              </div>
            </div>
            <div class="row">
              <div class="input-field col m6 s12">
              <h6>company phone</h6>
                <input id="phone" type="number" class="validate">
               
              </div>
              <div class="input-field col m6 s12">
                <input id="budget" type="text" class="validate">
                <label for="budget">App budget</label>
              </div>
              <div class="input-field col s12 width-100">
                <textarea id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">Textarea</label>
                <a class="waves-effect waves-light btn">Send</a>
              </div>
            </div>
          </form>
        </div>
      </div>



@section('page_js')
@endsection
@endsection