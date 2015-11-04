jQuery(function($) {
    if ( ! $('#crm-customer-statuses').length) {
        return false;
    }

    var $statuses = $('#crm-customer-statuses-list'),
        $forms = $('.js-status-form'),
        $quickForm = $('#crm-customer-status-quick-form'),
        rules = { name: 'required' };

    $forms.providerAjaxForm({ rules: rules });

    $quickForm.providerAjaxForm({
        rules: rules,
        afterSuccess: function($form, response) {
            var $updateForm = $forms.last().clone();

            $updateForm.providerAjaxForm({ rules: rules });
            $updateForm.attr('action', response.route);

            $updateForm.find('input[name="name"]').val($form.find('input[name="name"]').val());
            $updateForm.find('input[type="radio"]').filter(function() {
                return $(this).val() == $form.find('input[name="color"]:checked').val();
            }).attr('checked', true);

            $updateForm.find('.js-button-destroy').attr('data-url', response.route);

            $statuses.append($updateForm);
        }
    });
});