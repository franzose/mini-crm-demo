<!doctype html>
<html lang="ru" class="uk-height-1-1 uk-notouch">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему • Промторгстрой</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
</head>
<body class="page-login uk-height-1-1">
<div class="layout uk-vertical-align uk-text-center uk-height-1-1">
    <div class="uk-vertical-align-middle">
        @if ($errors->has('login'))
            <div class="uk-alert uk-alert-danger">
                {{ $errors->first('login') }}
            </div>
        @endif
        {!! Form::open([
            'route' => 'auth.login.do',
            'method' => 'post',
            'id' => 'crm-login-form',
            'class' => 'uk-panel uk-panel-box uk-form'
        ]) !!}
            <div class="uk-form-row">
                {!! Form::text('login', '', [
                    'class' => 'uk-width-1-1 uk-form-large',
                    'placeholder' => 'Логин',
                    'required' => true
                ]) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::password('password', [
                    'class' => 'uk-width-1-1 uk-form-large',
                    'placeholder' => 'Пароль',
                    'required' => true
                ]) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::button('Войти', [
                    'type' => 'submit',
                    'class' => 'uk-width-1-1 uk-button uk-button-primary uk-button-large'
                ]) !!}
            </div>
            <div class="uk-form-row uk-text-small">
                <label class="uk-float-left">
                    {!! Form::checkbox('remember') !!} Запомнить меня
                </label>
                {{-- <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a> --}}
            </div>
        {!! Form::close() !!}
    </div>
</div>
<script src="{{ asset('/assets/js/app.js') }}"></script>
</body>
</html>