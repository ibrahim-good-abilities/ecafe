/*
 * DataTables - Tables
 */


$(function () {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


  $('#main_inventory_table').DataTable({
    "responsive": true,
   
    "language": {
        "url": language
    } ,
    columnDefs: [
      { orderable: false, targets: -1 }
   ]
   });

  


   document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.modal').modal();
  });
      

  
})
