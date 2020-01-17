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
$('.news_slider').slick({
    dots: true,
    rows: 3,
    slidesPerRow: 3,
    arrows: false,
    responsive: [
        {
            breakpoint: 769,
            settings: {
                slidesPerRow: 2,
                rows: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesPerRow: 1,
                rows:3
            }
        }
    ]
});
$(document).on('click', '.review_view-more', function () {
    let id = parseInt($(this).attr('data-id'));
    let review;
    reviews.forEach(function (item) {
        if(item['id'] === id){
            review = item;
        }
    });
    if(review !== undefined){
        $('#review_photo').attr('src', `/uploads/${review.image}`);
        $('#review_title').text(review.name);
        $('#review_text').text(review.description);
    }
});
$('.gallery_slider').slick({
    infinite: false,
    slidesToShow: 4.3,
    slidesToScroll: 1,
    prevArrow: "<button class='prev'></button>",
    nextArrow: "<button class='next'></button>",
    appendArrows: $('.gallery_controls'),
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

