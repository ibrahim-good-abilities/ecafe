$(document).ready(function() {


    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";

    var t = $('#order').DataTable({
        searching: false,
        paging: false,
        info: false,
        "ordering": false,
        "language": {
            "url": language
        },
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [{
                "targets": [3],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [5],
                "visible": false
            },
            {
                width: '20%',
                targets: 0
            },
            {
                width: '50px',
                targets: 4
            }
        ],
        fixedColumns: true
    });

});