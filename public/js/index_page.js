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
if(localStorage.getItem('promotion') !== null){
    $.ajax({
        method: "POST",
        url: '/api/v1/promotion',
        data: {
            'promotion': localStorage.getItem('promotion')
        }
    })
        .done(function (data) {
            let input = $('#promocode_input');
            if(data.exists){
                $('#promo').click();
                promotion = localStorage.getItem('promotion');
                input.val(localStorage.getItem('promotion'));
                let parent_span = $('<span class="promocode_message"></span>').html('<i style="color: green" class="fas fa-check-circle"></i> Активний промокод: ');
                let child_span = $('<span class="promocode_active"></span>').text(data.exists);
                let promotion_div = $('<div class="promocode_change">Змiнити промокод</div>');
                parent_span.append(child_span);
                $('.promocode_body').append(parent_span).append(promotion_div);
            }
            localStorage.removeItem('promotion');
        });
}
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
    if(this.checked)
        $('#promocode_input').focus();

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
                    promotion = input.val();
                    let parent_span = $('<span class="promocode_message"></span>').html('<i style="color: green" class="fas fa-check-circle"></i> Активний промокод: ');
                    let child_span = $('<span class="promocode_active"></span>').text(data.exists);
                    let promotion_div = $('<div class="promocode_change">Змiнити промокод</div>');
                    parent_span.append(child_span);
                    $('.promocode_body').append(parent_span).append(promotion_div);
                }
                else{
                    input.focus();
                    promotion = false;
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
    $('#promocode_input').focus();
});


$('#tel').mask('+38 (999) 999 - 99 - 99', {
    placeholder: '+38(___)___-__-__'
});


$(function() {
    $("form[name='form_order']").validate({
        language: 'ru',
        rules: {
            name: {
                required: true,
            },
            telephone: {
                required: true,
            }
        },
        messages: {
            name: 'Введите ваше имя',
            telephone: 'Введите ваш телефон'
        },

        submitHandler: function(form) {
            let data = $("form[name='form_order']").serializeArray();
            let form_data = new FormData();
            data.forEach(function (elem) {
                form_data.append(elem['name'], elem['value']);
            });
            form_data.append('promotion', promotion);
            $.ajax({
                method: "POST",
                url: '/api/v1/submit_application',
                data: form_data,
                processData: false,
                contentType: false,
            })
                .done(function () {
                    modalWindow("Запит на запис до лікаря надіслано, ми з вами зв'яжемося в найближчий час!");
                    form.reset();
                    $('.promocode_message').remove();
                    $('.promocode_change').remove();
                    promotion = false;
                    $('.promocode_body').slideToggle(false);
                });
        }
    });
});

