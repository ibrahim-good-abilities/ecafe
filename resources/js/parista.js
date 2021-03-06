$(document).ready(function() {
    // Enable pusher logging - don't include this in production

    function initSlick() {
        if ($('.order-box').length == 0) {
            $('.empty-orders').removeClass('hidden');
        } else {
            $('.empty-orders').addClass('hidden');
            $('#orders').slick({
                slidesToShow: 4,
                infinite: false,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: true,
                            slidesToShow: 3,
                            infinite: false,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: true,
                            slidesToShow: 1,
                            infinite: false,
                        }
                    }
                ]
            });
        }

    }



    function removeSlide(index) {
        $('#orders').slick('slickRemove', index).slick('unslick');
        initSlick();

    }

    $(document).on('click', '.hide-order', function() {
        var index = $(this).closest(".slick-slide").data("slick-index");
        removeSlide(index);
    });
    $(document).on('click', '.make-in-progress', function() {
        var item_id = $(this).data('item_id');
        var that = $(this);
        $(this).addClass('hidden');
        $.post(base_url + '/orderline/update/status/' + item_id, { 'status': 'in progress', 'ajax': true, '_token': $('#_order_token').val() }, function(response) {
            if (response) {
                that.closest('div').find('.make-ready').removeClass('hidden');
            }
        });
    });

    $(document).on('click', '.make-ready', function() {
        var item_id = $(this).data('item_id');
        var that = $(this);
        $(this).addClass('hidden');
        $.post(base_url + '/orderline/update/status/' + item_id, { 'status': 'done', 'ajax': true, '_token': $('#_order_token').val() }, function(response) {
            if (response) {
                that.closest('div').find('.disabled').removeClass('hidden');
            }
        });
    });

    $('.complete-order').on('click', function() {
        $(this).closest('.order-box').find('.make-in-progress').addClass('hidden');
        $(this).closest('.order-box').find('.make-ready').addClass('hidden');
        $(this).closest('.order-box').find('.disabled').removeClass('hidden');
        var order_id = $(this).data('order_id');
        var that = $(this);
        $(this).addClass('hidden');;
        $.post(base_url + '/orders/update/status/' + order_id, { 'status': 'done', 'ajax': true, '_token': $('#_order_token').val() }, function(response) {
            if (response) {
                that.closest('div').find('.hide-order').removeClass('hidden');
            }
        });
    });


    initSlick();

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher(pusher_app_key, {
        cluster: 'eu',
        forceTLS: true
    });

    var channel = pusher.subscribe('parista');
    channel.bind('new-order', function(data) {
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        notify(data.message)
        snd.play();
        setTimeout(() => {
            location.reload();
        }, 2000);

    });
    channel.bind('call-action', function(data) {
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        notify(data.message)
        snd.play();
    });
    
    $('.tooltipped').tooltip();

});
