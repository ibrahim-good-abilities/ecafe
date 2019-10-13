$(document).ready(function() {
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher(pusher_app_key, {
        cluster: 'eu',
        forceTLS: true
    });


    function redrawThePage() {
        if ($('.order-content').length > 0) {
            $(".empty-orders").addClass('hidden');
        } else {
            $(".empty-orders").removeClass('hidden');
        }
    }

    redrawThePage();
    $(document).on('click', 'a[href="#payment"]', function(e) {
        var order_id = $(this).closest('div').data('order_id');
        $("#payment input[name='order_id']").val(order_id);

        var order_total = $(this).closest('div').data('order_total');
        $("#payment p[name='order_total']").html(order_total);

        $('#payment2').on('click', function(e) {
            var data = {
                '_token': $('#_order_token').val(),
                'order_id': order_id,
            };

            $.post(base_url + '/cashier/order', data, function(response) {
                if (response) {
                    $('.modal').modal();
                    $('.order-content[data-order_id="' + order_id + '"]').remove();
                    redrawThePage();
                }
            });
            e.preventDefault();

        });

        e.preventDefault();
    });

    $('.modal').modal();




    $('#input').on('keyup', function() {
        var num = $('#input').val();
        var val = $("#total").text();
        var total = num - val;
        $(".third-line p").html(total);
    });

    var channel = pusher.subscribe('cashier');
    channel.bind('order-status', function(data) {
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        notify(data.message)
        var promise = snd.play();
        if (promise) {
            //Older browsers may not return a promise, according to the MDN website
            promise.catch(function(error) { console.log(error); });
        }
    });
});
