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
let promotion = false;
$('#promo').click(function() {
    $('.contact_form form').toggleClass('active');
    if(!this.checked){
        promotion = false;
        $('#promocode_input').val('');
        $('.promocode_message').remove();
        $('.promocode_change').remove();
    }

    $('.promocode_body').slideToggle(this.checked);
});
$(document).on('click', '.promocode_use', function () {
    let input = $('#promocode_input');
    promotion = false;
    $('.promocode_message').remove();
    $('.promocode_change').remove();
    if(input.val() !== ''){
        $.ajax({
            method: "POST",
            url: '/api/v1/promotion',
            data: {
                'promotion': input.val()
            }
        })
            .done(function (data) {
                if(data.exists){
                    let parent_span = $('<span class="promocode_message"></span>').html('<i style="color: green" class="fas fa-check-circle"></i> Активний промокод: ');
                    let child_span = $('<span class="promocode_active"></span>').text(data.exists);
                    let promotion_div = $('<div class="promocode_change">Змiнити промокод</div>');
                    parent_span.append(child_span);
                    $('.promocode_body').append(parent_span).append(promotion_div);
                }
                else{
                    let parent_span = $('<span class="promocode_message" style="color: red"></span>').html('<i class="fas fa-exclamation-triangle"></i> Невiрний промокод');
                    $('.promocode_body').append(parent_span);
                }
            });
    }

});
$(document).on('click', '.promocode_change', function () {
    promotion = false;
    $('#promocode_input').val('');
    $('.promocode_message').remove();
    $('.promocode_change').remove();
});
