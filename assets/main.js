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

    // // go to the latest tab, if it exists:
    // var lastTab = sessionStorage.getItem('lastTab');
    // if (lastTab) {
    //     $('[href="' + lastTab + '"]').addClass('active');
    //     $(lastTab).addClass('show active');
    // } else {
    //     let firstTab = $('#dashboard [data-bs-toggle="pill"]:first').addClass('active');
    //     $(firstTab.attr('href')).addClass('show active');
    // }

    // clear sessionStorage on navbar-brand click
    $('.navbar-brand:first').on('click', function () {
        sessionStorage.clear();
    })

    // scroll header
    $(window).scroll(function () {
        var sticky = $('#MainNav'),
            scroll = $(window).scrollTop();

        if (scroll >= 100) sticky.addClass('nav-dark');
        else sticky.removeClass('nav-dark');
    });

    //select2
    $('.select2').select2();

    $(document).on('click', '[name=self]', function (e) {
        if ($(this).val() === '0') {
            $('#otherName').show();
        } else {
            $('#otherName').hide();
        }
    });

    feather.replace({'aria-hidden': 'true'});


    let segment = location.pathname.split('.php');
    let pathID = null;

    segment = segment ? segment[0].split('/')[2] : null;
    pathID = $(`#${segment ? segment : null}`);
    if (!pathID.length) {
        segment = segment ? segment[0].split('/')[1] : null;
        pathID = $(`#${segment ? segment : null}`);
    }

    if (!pathID?.length) {
        pathID = $(`#index`);
    }

    pathID?.addClass('active').parents('.collapse').addClass('show').parents('.collapsed').removeClass('collapsed');

    // confirm
    $(document).on('click', '[data-confirm]', function (e) {
        e.preventDefault();
        let conf = confirm($(this).data('confirm'));

        if (conf) {
            window.location = $(this).attr('href');
        }
    });

});