$(function() {
    'use strict'

    $('[data-toggle="offcanvas"]').on('click', function() {
        $('.offcanvas-collapse').toggleClass('open')
    })

    $('#modal-confirmation').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let formId = button.data('form-id')
        let modal = $(this)

        modal.find('.btn-continue').on('click', function() {
            $('#' + formId).submit()
        })
    })

    if (window.location.pathname != '/') {
        let pathname = window.location.pathname;
        $('#top-menu > ul a.dropdown-item').each(function(i, o) {
            let group = $(o).data('group');
            var n = pathname.indexOf(group);

            if (n >= 0) {
                $(this).parents('li:first').addClass('active');
                return;
            }
        });
    } else {
        $('#top-menu > ul:first li.nav-item:first').addClass('active');
    }
})