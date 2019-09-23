@extends('layout')
@section('title', 'Add Category')
@section('page_css')
@endsection
@section('middle_content')
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
        <div class="card-content black-text">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong  >{{ $message }}</strong>
        </div>
</div>
@endif

<form action="store" method="post"   enctype="multipart/form-data">
                @csrf
<div class="card">
    <div class="card-content">
        <h4 class="card-title">Add Category</h4>
        <div class="row">
            <div class="col s12">

                <div class="input-field">
                    <input placeholder="Placeholder" id="first_name" type="text" class="validate" name="category_name">
                    <label for="first_name">First Name</label>

                </div>
            </div>

            <div class="col s12">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Image</span>
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
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
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
