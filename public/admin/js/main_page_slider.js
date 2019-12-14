$(document).ready(function () {
    $(document).on('click', '.remove-slide', function () {
        let id = $(this).attr('data-id');
        if (confirm('Вы уверены, что хотите удалить этот слайд?')) {
            location.href = '/adminPanel/main_page_slider/delete/' + id;
        }
    });

    let sortable = $('#sortable');
    sortable.sortable({
        axis: "y"
    });
    sortable.on("sortupdate", function () {
        let arr = [];
        $("#sortable").find($('li')).each(function () {
            arr.push($(this).attr('data-id'));
        });
        console.log(arr);
        $.ajax({
            method: "GET",
            url: '/adminPanel/main_page_slider/update_queue/',
            data: {
                'queue': arr
            }
        })
        .done(function () {
            $('#finished').fadeIn('fast').fadeOut('');
        });
    });
});