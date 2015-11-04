@set($creating = (isset($action) && $action == 'store'))
<div class="uk-form-row">
    {!! Form::label('password', 'Пароль', ['class' => 'uk-form-label' . ($creating ? ' uk-form-label-required' : '')]) !!}
    <div class="uk-form-controls">
        {!! Form::password('password') !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('password_confirmation', 'Подтверждение пароля', ['class' => 'uk-form-label' . ($creating ? ' uk-form-label-required' : '')]) !!}
    <div class="uk-form-controls">
        {!! Form::password('password_confirmation') !!}
    </div>
</div>