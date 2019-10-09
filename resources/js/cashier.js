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
    $(document).on('click', '.make-ready', function() {
        var item_id = $(this).data('item_id');
        var that = $(this);
        $(this).addClass('hidden');;
        $.post(base_url + '/orderline/update/status/' + item_id, { 'status': 'done', 'ajax': true, '_token': $('#_order_token').val() }, function(response) {
            if (response) {
                that.closest('div').find('.disabled').removeClass('hidden');
            }
        });
    });

    $('.complete-order').on('click', function() {
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

    var pusher = new Pusher('c015a0a925da1961bddf', {
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


    $(document).on('click', 'a[href="#payment"]', function(e) {
        var order_id = $(this).closest('div').data('order_id');

        $("#payment input[name='order_id']").val(order_id);
        e.preventDefault();
    });
    $(document).ready(function() {
        $('.modal').modal();
    });




});
