$('document').ready(function () {

    // delete img in form
    $('body').on('click', '#img_delete', function (e) {
        e.preventDefault();
        $('#img_can_be_deleted').empty();
        $('#img_delete_input').val('');
    });
});