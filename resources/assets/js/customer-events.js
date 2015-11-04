jQuery(function($) {
    if ( ! $('#events-table').length) {
        return false;
    }

    var checkboxSelector = '.js-checkbox',
        checkallClass = 'js-checkbox-all',
        checkallSelector = '.' + checkallClass,
        $checkbox = $(checkboxSelector),
        $checkall = $(checkallSelector),
        checkboxesContainerSelector = '.js-checkboxes',
        checkboxIconSelector = '.js-checkbox-icon',
        checkboxIconClass = 'uk-icon-square',
        checkboxIconCheckedClass = 'uk-icon-check-square',
        checkboxIconCheckedSelector = '.' + checkboxIconCheckedClass;

    var $dates = $('.js-date'),
        $startDate = $('#start-date'),
        $endDate = $('#end-date'),
        $search = $('#search'),
        $types = $('#types'),
        $managers = $('#managers'),
        $customers = $('#customers'),
        $categories = $('#categories'),
        $statuses = $('#statuses'),
        $eventsContainer = $('#events-table-body'),
        $pagination = $('#pagination');

    /**
     *
     * @param {*} $icon
     * @returns {Object}
     */
    function getCheckboxClasses($icon) {
        var classes = {};

        if ($icon.hasClass(checkboxIconClass)) {
            classes.added = checkboxIconCheckedClass;
            classes.removed = checkboxIconClass;
        }
        else {
            classes.added = checkboxIconClass;
            classes.removed = checkboxIconCheckedClass;
        }

        return classes;
    }

    // Обработчик клика по чекбоксу в фильтре.
    //
    // Включает сам чекбокс, а также чекбокс "Выбрать все",
    // когда количество прощелканных чекбоксов равно их же общему количеству
    $checkbox.on('touchstart click', function() {
        var $this = $(this),
            $icon = $this.find(checkboxIconSelector),
            classes = getCheckboxClasses($icon);

        $icon.addClass(classes.added).removeClass(classes.removed);

        var $checkboxes = $this.closest(checkboxesContainerSelector)
            .find(checkboxSelector)
            .not(checkallSelector);

        var $checked = $checkboxes.filter(function(){
            return $(this).find(checkboxIconSelector).hasClass(checkboxIconCheckedClass);
        });

        var $all = $this.closest(checkboxesContainerSelector).find(checkallSelector);

        if ( ! $this.hasClass(checkallClass)) {
            if ($checkboxes.length == $checked.length) {
                $all.find(checkboxIconSelector)
                    .addClass(checkboxIconCheckedClass)
                    .removeClass(checkboxIconClass);
            }
            else {
                $all.find(checkboxIconSelector)
                    .addClass(checkboxIconClass)
                    .removeClass(checkboxIconCheckedClass);
            }

            performFilter();
        }

        return false;
    });

    // Обработчик клика по чекбоксу "Выбрать все"
    $checkall.on('touchstart click', function() {
        var $this = $(this),
            $icon = $this.find(checkboxIconSelector),
            classes = getCheckboxClasses($icon);

        $this.closest(checkboxesContainerSelector)
            .find(checkboxSelector)
            .not($this)
            .find(checkboxIconSelector)
            .addClass(classes.removed)
            .removeClass(classes.added);

        performFilter();

        return false;
    });

    // При вводе в поле поиска осуществляем поиск.
    $search.on('keyup input change', function() {
        setTimeout(function() {
            performFilter();
        }, 500);
    });

    function getCheckedIds($obj) {
        var ids = [];

        $obj.find(checkboxIconCheckedSelector)
            .each(function() {
                var $parent = $(this).parent();

                if ( ! $parent.is(checkallSelector)) {
                    ids.push($parent.data('id'));
                }
            });

        return ids;
    }

    /**
     *
     * @returns {Object}
     */
    function getFilterData() {
        var data = {
                types: getCheckedIds($types),
                managers: getCheckedIds($managers),
                customers: getCheckedIds($customers),
                categories: getCheckedIds($categories),
                statuses: getCheckedIds($statuses)
            },
            startDate = $startDate.val(),
            endDate = $endDate.val(),
            query = $search.val();


        if (startDate) {
            data.start_date = startDate;
        }

        if (endDate) {
            data.end_date = endDate;
        }

        if (query) {
            data.query = query;
        }

        return data;
    }

    function performFilter() {
        var data = getFilterData();

        $eventsContainer.css({ opacity: .5 });
        $pagination.css({ opacity: .5 });

        $.ajax({
            url: '/crm/customer-event/filter',
            data: data,
            dataType: 'json',
            success: function(response) {
                $eventsContainer.html(response.events);
                $pagination.html(response.pagination);

                $eventsContainer.css({ opacity: 1 });
                $pagination.css({ opacity: 1 });
            }
        });
    }

    // Календари
    $dates.each(function() {
        UIkit.datepicker($(this)[0], {
            format: 'DD.MM.YYYY',
            i18n: {
                months: [
                    'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
                ],
                weekdays: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
            }
        });
    });

    $dates.on('input change keyup', function() {
        performFilter();
    });
});