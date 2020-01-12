$('.top_carousel').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    dots: true,
    arrows: false
});
$('.best_slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    prevArrow: "<button class='prev'></button>",
    nextArrow: "<button class='next'></button>",
    appendArrows: $('.best_controls'),
    // autoplay: true,
    autoplaySpeed: 5000,
    responsive: [
        {
            breakpoint: 769,
            settings: {
                slidesToShow: 1.8,
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
$('.doctors_slider').slick({
    infinite: true,
    slidesToShow: 4,
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
$('.reviews_slider').slick({
    infinite: false,
    slidesToShow: 1.5,
    slidesToScroll: 1,
    prevArrow: "<button class='prev'></button>",
    nextArrow: "<button class='next'></button>",
    appendArrows: $('.reviews_controls'),
    responsive: [
        {
            breakpoint: 769,
            settings: {
                slidesToShow: 1,
            }
        },
    ]
});
$('#promo').click(function() {
    $('.contact_form form').toggleClass('active');
    $('.promocode_body').slideToggle(this.checked);
});
