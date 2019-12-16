$(document).ready(function () {
    $(document).on('click', '.remove-service', function () {
        let id = $(this).attr('data-id');
        if (confirm('Вы уверены, что хотите удалить эту услугу?')) {
            location.href = '/adminPanel/mini_service/delete/' + id;
        }
    });
});