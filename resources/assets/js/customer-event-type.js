jQuery(function($) {
    if ( ! $('#crm-ce-types').length) {
        return false;
    }

    var $types = $('#crm-ce-types-list'),
        $forms = $('.js-type-form'),
        $quickForm = $('#crm-ce-type-quick-form'),
        rules = { name: 'required' };

    $forms.providerAjaxForm({ rules: rules });

    $quickForm.providerAjaxForm({
        rules: rules,
        afterSuccess: function($form, response) {
            var $updateForm = $forms.last().clone();

            $updateForm.providerAjaxForm({ rules: rules });
            $updateForm.attr('action', response.route)
                .find('input[name="name"]')
                .val($form.find('input[name="name"]').val());

            $updateForm.find('.js-button-destroy').attr('data-url', response.route);

            $types.append($updateForm);
        }
    });
});