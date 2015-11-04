jQuery(function($) {
    if ( ! $('#crm-roles').length) {
        return false;
    }

    var $roles = $('#crm-roles-list'),
        $forms = $('.js-role-form'),
        $quickForm = $('#crm-role-quick-form'),
        updateRules = { title: 'required'},
        createRules = {
            name: {
                required: true
            },
            title: 'required'
        };

    $forms.providerAjaxForm({ rules: updateRules });

    $quickForm.providerAjaxForm({
        rules: createRules,
        afterSuccess: function($form, response) {
            var $updateForm = $forms.last().clone();

            $updateForm.providerAjaxForm({ rules: updateRules });
            $updateForm.attr('action', response.route)
                .find('input[name="title"]')
                .val($form.find('input[name="title"]').val());

            $updateForm.find('.js-button-destroy').attr('data-url', response.route);

            $roles.append($updateForm);
        }
    });
});