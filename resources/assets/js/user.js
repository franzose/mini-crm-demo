jQuery(function($) {
    var $form = $('#crm-user-form');

    if ( ! $form.length) {
        return false;
    }

    $form.providerValidatedForm(function($this){
        var action = $this.data('action'),
            rules = {
                name: 'required',
                login: 'required',
                email: {
                    email: true
                }
            };

        if (action == 'store') {
            rules.password = {
                required: true,
                equalTo: '#password_confirmation'
            };
        }

        return rules;
    });
});