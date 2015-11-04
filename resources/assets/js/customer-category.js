jQuery(function($) {
    if ( ! $('#crm-customer-categories').length) {
        return false;
    }

    var $categories = $('#crm-customer-categories-list'),
        $forms = $('.js-customer-category-form'),
        $quickForm = $('#crm-customer-category-quick-form'),
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

            $categories.append($updateForm);
        }
    });
});