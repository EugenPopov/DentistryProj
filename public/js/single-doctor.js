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
if(localStorage.getItem('comment') !== null){
    $(document).find('#comment').val(`Я хотiв би записатися за послугою "${localStorage.getItem('comment')}"`);
    localStorage.removeItem('comment');
}
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
            name: `Введіть ваше ім'я`,
            telephone: 'Введіть ваш телефон'
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
let fancybox = $("[data-fancybox]");
if (fancybox.length) {
    fancybox.fancybox({
        buttons: ["close"],
        loop: true,
        clickContent: false,
        overlay: null
    });
}
$('#time').timepicker({
    'minTime': '9:00',
    'maxTime': '19:30',
    'timeFormat': 'H:i'
});
