jQuery(function($) {
    var $form = $('#crm-profile-form');

    if ( ! $form.length) {
        return false;
    }

    $form.providerAjaxForm({
        rules: {
            name: 'required',
            login: 'required',
            email: {
                email: true
            }
        }
    });
});