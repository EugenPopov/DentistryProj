$('.doctors_slider').slick({
    infinite: false,
    slidesToShow: 3.8,
    slidesToScroll: 1,
    prevArrow: "<button class='prev'></button>",
    nextArrow: "<button class='next'></button>",
    appendArrows: $('.doctors_controls'),
    responsive: [
        {
            breakpoint: 769,
            settings: {
                slidesToShow: 2,
                infinite: true,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                infinite: true,
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
                slidesToShow: 3.6,
                infinite: false,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2.6,
                infinite: false,
            }
        }
    ]
});
