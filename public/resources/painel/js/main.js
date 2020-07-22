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
        $('#top-menu > ul > li a').each(function(i, o) {
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

function ajax(url, data, options) {
    let defaultOption = {
        dataType: 'json',
        method: 'POST',
        url: url,
        data: data,
        success: function(data) {
            if (data.message) {
                alertModal(data.message)
            }
        },
        error: function(data) {
            if (typeof data.responseJSON == 'object' && data.responseJSON.message) {
                errorModal(data.responseJSON.message)
            } else if (typeof data.responseText != 'undefined') {
                errorModal(data.responseText)
            }
        }
    }

    $.extend(defaultOption, options);
    $.ajax(defaultOption);
}

function alertModal(text) {
    $('.modal').modal('hide')
    let modal = $('#modal-alert');
    modal.find('.modal-body').html(text)
    modal.modal('show')
}

function errorModal(text) {
    $('.modal').modal('hide')
    let modal = $('#modal-error');
    modal.find('.modal-body').html(text)
    modal.modal('show')
}