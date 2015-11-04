jQuery(function($) {
    var $form = $('#crm-customer-form');

    if ( ! $form.length) {
        return false;
    }

    $form.providerValidatedForm({
        'category_id': 'required',
        'manager_id': 'required',
        'name': 'required',
        'legal_name': 'required'
    });
});