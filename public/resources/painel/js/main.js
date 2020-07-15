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
})