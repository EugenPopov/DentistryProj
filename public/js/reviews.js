$('.reviews_slider').slick({
    dots: true,
    rows: 3,
    slidesPerRow: 4,
    prevArrow: "<button class='prev'></button>",
    nextArrow: "<button class='next'></button>",
    appendArrows: $('.reviews_controls'),
    responsive: [
        {
            breakpoint: 769,
            settings: {
                slidesPerRow: 3,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesPerRow: 2,
                rows:2
            }
        }
    ]
});
