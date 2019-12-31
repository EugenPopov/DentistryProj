$('.page_up').on('click', function () {
    $('.page_top_wrapper')[0].scrollIntoView({block: "start", behavior: "smooth"});
});
$('#main-header-toggle').on('click', function () {
    $('.mobile_nav-toogle').toggleClass('active');
    $('#mobile_nav').slideToggle(500);
    $('.main_header').toggleClass('active');

});
