$(document).ready(function() {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


    $('#orders').DataTable({
        "responsive": true,

        "language": {
            "url": language
        },
        columnDefs: [
            { orderable: false, targets: -1 }
        ]
    });



});