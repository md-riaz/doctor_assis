$(function () {
    setTimeout(function () {
        $("#removeAlert").slideUp(500, function () {
            $(this).remove();
        });
    }, 5000);

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    //dynamic modals
    $('#ajaxModal').on('hidden.bs.modal', function (e) {
        $(e.target).removeData('bs.modal').find('.modal-content').html('');
    })
    $('[data-bs-target="#ajaxModal"]').on('click', function (e) {
        $('#ajaxModal .modal-content').load($(this).data('href'), () => console.log('Modal loaded'));
    });

    // show last tab after refresh
    $('[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        sessionStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = sessionStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').addClass('active');
        $(lastTab).addClass('show active');
    } else {
        let firstTab = $('[data-bs-toggle="pill"]:first').addClass('active');
        $(firstTab.attr('href')).addClass('show active');
    }

    // clear sessionStorage on navbar-brand click
    $('.navbar-brand:first').on('click', function(){
        sessionStorage.clear();
    })
});