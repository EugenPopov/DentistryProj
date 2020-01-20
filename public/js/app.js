$('.page_up').on('click', function () {
    $('html,body').animate({scrollTop: $('.page_top_wrapper').offset().top}, 500, 'swing');
});
$('#main-header-toggle').on('click', function () {
    $('.mobile_nav-toogle').toggleClass('active');
    $('#mobile_nav').slideToggle(500);
    $('.main_header').toggleClass('active');

});
function modalWindow(word) {
    $(".modal_text").text(word);
    $("#modal").modal("show");
}
$('#date').datepicker({
    minDate: new Date(),
    onSelect: function (date) {
        console.log(date);
        $('#date').value = date;
    }
});
