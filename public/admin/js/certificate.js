$(document).on('click', '.remove-sertificate', function () {
    let id = $(this).attr('data-id');
    if (confirm('Вы уверены, что хотите удалить этот сертификат?')) {
        location.href = '/adminPanel/sertificate/delete/' + id;
    }
});

$(document).on('click', '#close-sortable', function () {
    $(this).toggleClass('opened');

    let card = $(this).parent().parent().find('.card-body');

    if($(this).hasClass('opened'))
        card.slideUp();
    else
        card.slideDown();
});

let sortable = $('#sortable');
sortable.sortable({
    axis: "y",
});
sortable.on("sortupdate", function () {
    let arr = [];
    $("#sortable").find($('li')).each(function () {
        arr.push($(this).attr('data-id'));
    });
    $.ajax({
        method: "POST",
        url: '/adminPanel/sertificate/update_queue/',
        data: {
            'queue': arr
        }
    })
        .done(function () {
            $('#finished').fadeIn('fast').fadeOut('');
        });
});