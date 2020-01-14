$(document).on('click', '.remove-application', function () {
    let id = $(this).attr('data-id');
    if (confirm('Вы уверены, что хотите удалить эту заявку?')) {
        location.href = '/adminPanel/application/delete/' + id;
    }
});