$(document).ready(function() {

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c015a0a925da1961bddf', {
        cluster: 'eu',
        forceTLS: true
    });

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


    var _channel = pusher.subscribe('captain');
    _channel.bind('order-status', function(data) {
        if ($(".selected.order-number[data-status='" + data.order_id + "']").length > 0) {
            $("#status").html(data.status);
        } else {
            setInterval(function() {
                if ($(".order-number[data-number='" + data.order_id + "']").hasClass('selected')) {
                    $(".order-number[data-number='" + data.order_id + "']").removeClass('selected');
                } else {
                    $(".order-number[data-number='" + data.order_id + "']").addClass('selected');
                }
            }, 500);
        }
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        notify(data.massage);
        snd.play();
    });

    _channel.bind('item-status', function(data) {
        debugger;
        if ($(".selected.order-number[data-number='" + data.order_id + "']").length > 0) {
            $("#status_" + data.item_id).html(data.status);
        } else {
            setInterval(function() {
                if ($(".order-number[data-number='" + data.order_id + "']").hasClass('selected')) {
                    $(".order-number[data-number='" + data.order_id + "']").removeClass('selected');
                } else {
                    $(".order-number[data-number='" + data.order_id + "']").addClass('selected');
                }
            }, 500);

        }
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        notify(data.massage);
        snd.play();
    });

});