$('.doctors_slider').slick({
    infinite: false,
    slidesToShow: 1.3,
    slidesToScroll: 1,
    prevArrow: "<button class='prev'></button>",
    nextArrow: "<button class='next'></button>",
    appendArrows: $('.doctors_controls'),
    responsive: [
        {
            breakpoint: 769,
            settings: {
                slidesToShow: 2.4,
                infinite: false,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1.5,
                infinite: false,
            }
        }
    ]
});
$('.certificates_slider').slick({
    infinite: false,
    slidesToShow: 4.3,
    slidesToScroll: 1,
    prevArrow: "<button class='prev'></button>",
    nextArrow: "<button class='next'></button>",
    appendArrows: $('.certificates_controls'),
    responsive: [
        {
            breakpoint: 769,
            settings: {
                slidesToShow: 2.4,
                infinite: false,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1.5,
                infinite: false,
            }
        }
    ]
});
