jQuery(function($) {
    var $form = $('#crm-customer-event-form');

    if ( ! $form.length) {
        return false;
    }

    UIkit.datepicker($('#event_date')[0], {
        format: 'DD.MM.YYYY',
        minDate: 0,
        i18n: {
            months: [
                'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ],
            weekdays: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
        }
    });

    UIkit.timepicker($('#event_time')[0], {
        start: 9,
        end: 19
    });

    $form.providerValidatedForm({
        type_id: 'required',
        customer_id: 'required',
        event_date: 'required',
        event_time: 'required',
        description: 'required'
    });
});