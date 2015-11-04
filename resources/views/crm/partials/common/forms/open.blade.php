@set($class = 'uk-form ' . ((!isset($horizontal) || $horizontal === true) ? 'uk-form-horizontal ' : '') . (isset($class) ? $class : 'uk-width-9-10'))
@set($route = implode('.', ['crm', get_current_resource(), $action]))

{!! Form::model($model, [
    'route' => ($action == 'store' ? $route : [$route, $model->id]),
    'method' => ($action == 'store' ? 'post' : 'put'),
    'id' => (isset($id) ? $id : ''),
    'class' => $class,
    'data-action' => $action,
    'novalidate' => true,
    'autocomplete' => 'off'
]) !!}