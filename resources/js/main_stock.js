/*
 * DataTables - Tables
 */


$(function() {

    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";


    $('#menu_items').DataTable({
        "responsive": false,

        "language": {
            "url": language
        },
        columnDefs: [
            { orderable: false, targets: -1 }
        ]
    });


    $(document).on('click', 'a[href="#transfer"]', function(e) {
        var product_id = $(this).closest('tr').data('item_id');
        $("#transfer input[name='item_id']").val(product_id);
        e.preventDefault();
    });

    $(document).on('click', 'a[href="#operations"]', function(e) {
        var product_id = $(this).closest('tr').data('item_id');
        $("#operations input[name='item_id']").val(product_id);
        e.preventDefault();
    });


    $(document).ready(function() {
        $('.modal').modal();
    });
})