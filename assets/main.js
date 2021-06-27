$(function () {
    setTimeout(function () {
        $("#removeAlert").slideUp(500, function () {
            $(this).remove();
        });
    }, 6000);

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
    $('#dashboard [data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        sessionStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = sessionStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').addClass('active');
        $(lastTab).addClass('show active');
    } else {
        let firstTab = $('#dashboard [data-bs-toggle="pill"]:first').addClass('active');
        $(firstTab.attr('href')).addClass('show active');
    }

    // clear sessionStorage on navbar-brand click
    $('.navbar-brand:first').on('click', function () {
        sessionStorage.clear();
    })

    // scroll header
    $(window).scroll(function () {
        var sticky = $('.navbar'),
            scroll = $(window).scrollTop();

        if (scroll >= 100) sticky.addClass('nav-dark');
        else sticky.removeClass('nav-dark');
    });

    //select2
    $('.select2').select2();

    $(document).on('click', '[name=self]', function (e) {
        if ($(this).val() === '1'){
            $('#otherName').show();
        } else {
            $('#otherName').hide();
        }
    })
});