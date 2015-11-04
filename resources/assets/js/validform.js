;(function($){
    $.fn.providerValidatedForm = function(rules){
        this.each(function() {
            $(this).submit(function() {
                var $this = $(this),
                    formRules = (typeof rules == 'function' ? rules($this) : rules);

                $this.validate(formRules);

                if ( ! $this.valid()) {
                    return false;
                }
            });
        });
    };
})(jQuery);