@extends('layout')
@section('title', 'Main store')
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/main_store.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">

@endsection
@section('middle_content')

     <div class="row">
        <div class="col s12">
          <div id="button-trigger" class="card card card-default scrollspy">
             <!-- main store -->
            <div class="card-content">
              <h4 class="card-title">Main Store</h4>
                  <table id="main_inventory_table" class="display">
                    <thead>
                      <tr>
                          <th>الرقم التسلسلي</th>
                          <th>اسم المنتج</th>
                          <th>الكميه</th>
                          <th>الاعدادات</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>
                          <td>20</td>
                          <td>
                            <span class="avatar-item "><img src="../../../app-assets/images/avatar/avatar-1.png" alt="avatar"></span>
                          قهوه
                          </td>
                          <td>20</td>
                          <td class="center-align">
                             <a class=" modal-trigger" href="#modal2"><i class="material-icons pink-text">clear</i></a>
                             <a class=" modal-trigger" href="#modal1"><i class="material-icons dp48">visibility</i></a>
                             </td>
                      </tr>
                    
                    </tbody>
                  </table>
            </div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
<div class="modal-content">
  <h4>Modal Header</h4>
  <p>A bunch of text</p>
</div>
<div class="modal-footer">
  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
</div>
</div>
<div id="modal2" class="modal">
<div class="modal-content">
  <h4>Modal 22222</h4>
  <p>A bunch of text</p>
</div>
<div class="modal-footer">
  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
</div>
</div>

                  <!-- main store -->
          </div>
        </div>
      </div>
</div>
 @section('page_js')
 <script>
    var language = "{{asset('resources/json/Arabic.json')}}";
</script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/vendors/slick/slick.min.js')}}" type="text/javascript"></script>
 <script src="{{asset('resources/js/main_store.js')}}" type="text/javascript"></script>
 @endsection
 @endsection

