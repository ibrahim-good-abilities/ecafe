@extends('layout')
@section('title', __('Edit Category'))
@section('page_css')
@endsection
@section('middle_content')
<div class="row">
   <div class="col s12">
      @if ($message = Session::get('success'))
      <div class="card-alert card green lighten-5">
            <div class="card-content green-text">
         <button type="button" class="close" data-dismiss="alert">×</button>
            <strong  >{{ $message }}</strong>
            </div>
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
      <form action="{{ route('category_update',$category->id) }}" method="post" enctype="multipart/form-data" >
         @csrf
               <div class="row">
                  <div class="input-name col s12">
                     <input  name="category_name" id="category_name" type="text" class="validate">
                     <label for="first_name">{{ __('Category Name') }}</label>
                  </div>

                  <div class="col s12 file-field input-field">
                        <div class="btn float-left">
                           <span>{{ __('Category Image') }}</span>
                           <input type="file" name="img">
                        </div>
                        <div class="file-path-wrapper">
                           <input class="file-path validate" type="text">
                        </div>
                  </div>

                  <div class="input-field col s12">
                     <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                        <i class="material-icons right">send</i>
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </form>
      @section('page_js')
      @endsection
@endsection
