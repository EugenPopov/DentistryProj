$(document).ready(function () {
    bsCustomFileInput.init();
    let url = location.pathname;


    $('a').each(function () {
        if($(this).attr('href') === location.pathname)
            $(this).parent().addClass('active');
        else if(url.includes($(this).attr('href')))
            $(this).parent().addClass('active');
    });

    $('input').each(function () {
        if($(this).prop('required')){
            $(this).labels()[0].append(' *Обязательно')
        }
    });
    $('textarea').each(function () {
        if($(this).prop('required')){
            $(this).labels().append(' *Обязательно')
        }
    });

    $('input[type=file]').each(function () {
        if($(this).hasClass('has_image'))
            $(this).parent().after(`<a target="_blank" href="/uploads/${$(this).attr('data-image')}"><img style="width: 250px; height: 250px; padding-top: 10px; object-fit: cover" src="/uploads/${$(this).attr('data-image')}"></a><br>Старое фото:`);

    });

    $.ajax({
        method: "GET",
        url: '/adminPanel/api/getNewApplications',
    })
        .done(function (amount) {
            $('.application-amount').text(amount?amount:'');
            $('.application-amount-li').text(amount?amount:'нет');
        });
});
