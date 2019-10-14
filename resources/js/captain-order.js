$(document).ready(function() {

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher(pusher_app_key, {
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
        slidesToShow: 8,
        slidesToScroll: 8,
        infinite: false,
    });

    setTimeout(() => {
        $('#active-orders').slick('slickGoTo', $('.order-number.selected').data('slick-index') - 1);
    }, 1000);


    $(document).on('click', '.order-number', function() {
        document.location.href = $(this).data('href');
    });


    var _channel = pusher.subscribe('captain');
    _channel.bind('order-status', function(data) {
        if ($(".selected.order-number[data-number='" + data.order_id + "']").length > 0) {
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
        notify(data.message);
        snd.play();
    });

    _channel.bind('item-status', function(data) {

        if ($(".selected.order-number[data-number='" + data.order_id + "']").length > 0) {
            $("#status_" + data.item_id).html(data.status);
            if (data.status == 'اكتمل') {
                $("#status_" + data.item_id).closest('tr').addClass('dimmed-row');
            }

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
        notify(data.message);
        snd.play();
    });

});