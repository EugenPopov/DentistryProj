$(document).ready(function () {
    $(document).on('click', '.promotion_use', function () {
        let code = $(this).attr('data-code');
        localStorage.setItem('promotion', code);
        location.href = '/#contact_wrapper';
    });
});