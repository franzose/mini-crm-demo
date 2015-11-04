jQuery(function($) {
    var $body = $('body');

    var modal = [
        '<div id="unathorized-modal" class="uk-modal">',
        '<div class="uk-modal-dialog">',
        '<a class="uk-modal-close uk-close"></a>',
        '<div id="unauthorized-modal-content"></div>',
        '</div>',
        '</div>'
    ].join('');

    $body.append(modal);

    var $modalContent = $('#unauthorized-modal-content');

    $(document).ajaxError(function(event, xhr) {
        // Не авторизован
        if (xhr.status == 401) {
            $modalContent.html(JSON.parse(xhr.responseText).unauthorized);

            var uikitModal = UIkit.modal("#unathorized-modal");

            if (uikitModal.isActive()) {
                uikitModal.hide();
            } else {
                uikitModal.show();
            }
        }
    });
});