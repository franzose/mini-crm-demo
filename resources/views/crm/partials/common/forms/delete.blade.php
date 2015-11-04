@set($id = (isset($id) ? $id : get_current_id()))
@set($ajax_destroy = (isset($ajax_destroy) && $ajax_destroy === true) ?: false)

<button class="uk-button uk-button-danger uk-button-destroy js-button-destroy"
        data-url="{{ destroy_route($id) }}"
        data-token="{{ csrf_token() }}"
        data-confirm="Вы действительно хотите произвести удаление?"
        @if ($ajax_destroy) data-ajax-destroy @endif>
    <i class="uk-icon-trash"></i>
    Удалить
</button>