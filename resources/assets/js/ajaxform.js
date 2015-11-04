;(function($, undefined) {
    var defaults = {
        submit: '.js-submit',
        submitIcon: '<i class="uk-icon-spinner uk-icon-spin js-spinner"></i>'
    };

    $.fn.providerAjaxForm = function(options) {
        var $errorLabel = $('<label class="error"></label>');

        /**
         * Выставляет метку с ошибкой валидации к соответствующему полю.
         *
         * @param {*} $field
         * @param {String} text
         */
        function attachErrorLabel($field, text) {
            var $next = $field.next();

            if ($next.is('label')) {
                $next.text(text).css({ display: 'block' });
            }
            else {
                $errorLabel.clone()
                    .text(text)
                    .insertAfter($field);
            }
        }

        /**
         * Выставляет разметку с ошибками валидации.
         *
         * @param {*} $form
         * @param {Object} fields
         * @param {Object} overrides
         */
        function attachErrorLabels($form, fields, overrides) {
            $.each(fields, function(field, text) {
                // По умолчанию ищем поля из объекта fields
                var $field = $form.find('[name="' + field + '"]');

                // Если есть переопределенные поля, берем их
                if (overrides && overrides.hasOwnProperty(field)) {
                    $field = overrides[field];
                }
                // Если надо вывести ошибку или поле не было найдено,
                // помещаем маркер рядом с кнопкой отправки формы
                else if (field == 'error' || ! $field.length) {
                    $field = $form.find('.js-submits');

                    if ( ! $field.length) {
                        $field = $form.find('[type="submit"]');
                    }
                }

                attachErrorLabel($field, text);
            });
        }

        this.each(function() {
            var $form = $(this);

            $form.submit(function() {
                var $this = $(this),
                    formOptions = $.extend(defaults, options);

                $this.validate(formOptions.rules);

                if ( ! $this.valid()) {
                    return false;
                }

                var $submit = $this.find(options.submit);

                $submit.append(formOptions.submitIcon).attr('disabled', true);

                $.ajax({
                    url: $this.attr('action'),
                    method: $this.attr('method'),
                    data: $this.serialize(),
                    dataType: 'json',
                    success: formOptions.onSuccess || function(response) {
                        UIkit.notify({
                            message: response.success,
                            status: 'success',
                            timeout: 2000,
                            pos: 'top-center'
                        });

                        if (typeof formOptions.afterSuccess == 'function') {
                            formOptions.afterSuccess($this, response);
                        }
                    },
                    error: formOptions.onError || function(response) {
                        if (response.status == 422) {
                            attachErrorLabels($this, response.responseJSON, formOptions.overrides);
                        }
                        else {
                            console.log(response);
                        }

                        if (typeof formOptions.afterError == 'function') {
                            formOptions.afterError($this, response);
                        }
                    },
                    complete: formOptions.onComplete || function(response) {
                        $submit.find('.js-spinner').remove();
                        $submit.removeAttr('disabled');

                        if (typeof formOptions.afterComplete == 'function') {
                            formOptions.afterComplete($this, response);
                        }

                        if ( ! $this.find('input[name="_method"]').length) {
                            $this[0].reset();
                        }
                    }
                });

                return false;
            });
        });
    };

    $('.js-button-destroy').each(function() {
        var $this = $(this),
            isAjax = $this.attr('data-ajax-destroy') != undefined;

        if (isAjax) {
            return false;
        }

        var action = $this.data('url'),
            token = $this.data('token');

        $this.append(function() {
            return '<form action="' + action + '" method="post">' +
                '<input type="hidden" name="_method" value="DELETE">' +
                '<input type="hidden" name="_token" value="' + token + '">' +
                '</form>';
        });

        $this.on('touchstart click', function() {
            var $link = $(this);

            if ( ! confirm($link.data('confirm'))) {
                return false;
            }

            $link.find('form').submit();
        });
    });

    $('body').on('touchstart click', '.js-button-destroy', function() {
        var $this = $(this);

        if ($this.attr('data-ajax-destroy') == undefined) {
            return false;
        }

        if (confirm($this.data('confirm'))) {
            $this.append(defaults.submitIcon).attr('disabled', true);

            $.ajax({
                url: $this.data('url'),
                method: 'post',
                data: {
                    _method: 'delete',
                    _token: $this.data('token')
                },
                dataType: 'json',
                success: function(response) {
                    UIkit.notify({
                        message: response.success,
                        status: 'success',
                        timeout: 2000,
                        pos: 'top-center'
                    });

                    $this.closest('form').fadeOut(function() {
                        $(this).remove();
                    });
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        return false;
    });
})(jQuery);