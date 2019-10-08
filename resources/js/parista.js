$(document).ready(function() {
    // Enable pusher logging - don't include this in production
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

});