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
            width: '50px',
            targets: 3
        }],
        fixedColumns: true
    });

    $('#active-orders').slick({
        slidesToShow: 6,
        infinite: false,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: 3,
                    infinite: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    infinite: false,
                }
            }
        ]
    });

    $(document).on('click', '.order-number', function() {
        document.location.href = $(this).data('href');
    });

});