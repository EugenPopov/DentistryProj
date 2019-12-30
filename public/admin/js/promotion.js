$(document).on('click', '.remove-promotion', function () {
    let id = $(this).attr('data-id');
    if (confirm('Вы уверены, что хотите удалить этот сертификат?')) {
        location.href = '/adminPanel/promotion/delete/' + id;
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

$(document).on('change', '.switch-active', function () {
    let bool = $(this).prop('checked') ? 1 : 0;
    let id = $(this).attr('data-id');
    $.ajax({
        method: "POST",
        url: '/adminPanel/promotion/update_active/',
        data: {
            active: Number(bool),
            id: id
        }
    });
});

$(document).on('change', '.switch-public', function () {
    let bool = $(this).prop('checked') ? 1 : 0;
    let id = $(this).attr('data-id');
    $.ajax({
        method: "POST",
        url: '/adminPanel/promotion/update_public/',
        data: {
            active: Number(bool),
            id: id
        }
    });
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
        url: '/adminPanel/promotion/update_queue/',
        data: {
            'queue': arr
        }
    })
        .done(function () {
            $('#finished').fadeIn('fast').fadeOut('');
        });
});