$(function () {
    setTimeout(function () {
        $("#removeAlert").slideUp(500, function () {
            $(this).remove();
        });
    }, 5000);

    //dynamic modals
    $('#ajaxModal').on('hidden.bs.modal', function (e) {
        $(e.target).removeData('bs.modal').find('.modal-content').html('');
    })
    $('[data-bs-target="#ajaxModal"]').on('click', function (e) {
        $('#ajaxModal .modal-content').load($(this).data('href'), () => console.log('Modal loaded'));
    });
});