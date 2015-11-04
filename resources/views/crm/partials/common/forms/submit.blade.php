@set($creating = (isset($creating) ? $creating : (isset($action) && $action == 'store' ? true : false)))
@set($text = ($creating ? 'Создать' : 'Сохранить'))
@set($is_ajax = (isset($is_ajax) ? $is_ajax : false))
@set($btn_class = 'uk-button uk-button-primary' . ($is_ajax ? ' js-submit' : ''))

{!! Form::button($text, ['type' => 'submit', 'class' => $btn_class]) !!}