$(document).ready(function() {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


    $('#coupons').DataTable({
        "responsive": false,

        "language": {
            "url": language
        },
        columnDefs: [
            { orderable: false, targets: 5 }
        ]
    });  
 
});
