/*
 * DataTables - Tables
 */


$(function() {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


    $('#packing-units-table').DataTable({
        "responsive": false,

        "language": {
            "url": language
        },

    });



})