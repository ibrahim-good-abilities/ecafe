$(document).ready(function() {
    // Enable pusher logging - don't include this in production
    function initSlick(){
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



    function removeSlide(index){
        $('#orders').slick('slickRemove', index).slick('unslick');
        initSlick();

    }

    $('.hide-order').on('click', function() {
      var index = $(this).closest(".slick-slide").data("slick-index");
      removeSlide(index);
    });
    initSlick();

});

