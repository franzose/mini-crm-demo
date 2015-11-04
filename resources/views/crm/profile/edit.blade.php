@extends('crm.layouts.master')
@section('page-title', 'Ваш профиль')
@section('content-title', 'Ваш профиль')
@section('content')
    {!! Form::model($user, [
        'route' => 'crm.profile.update',
        'method' => 'put',
        'id' => 'crm-profile-form',
        'class' => 'uk-form uk-form-horizontal uk-width-9-10',
        'novalidate' => true
    ]) !!}
    <div class="uk-form-row">
        {!! Form::label('name', 'ФИО', ['class' => 'uk-form-label uk-form-label-required']) !!}
        <div class="uk-form-controls">
            {!! Form::text('name', null, ['required' => true]) !!}
        </div>
    </div>
    <div class="uk-form-row">
        {!! Form::label('login', 'Логин', ['class' => 'uk-form-label uk-form-label-required']) !!}
        <div class="uk-form-controls">
            {!! Form::text('login', null, ['required' => true]) !!}
        </div>
    </div>
    <div class="uk-form-row">
        {!! Form::label('email', 'E-mail', ['class' => 'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::email('email') !!}
        </div>
    </div>
    <div class="uk-form-row">
        {!! Form::label('phone', 'Телефон', ['class' => 'uk-form-label']) !!}
        <div class="uk-form-controls">
            {!! Form::text('phone') !!}
        </div>
    </div>
    <hr>
    @include('crm.partials.common.forms.password')
    <div class="uk-form-row">
        @include('crm.partials.common.forms.submit', ['is_ajax' => true])
    </div>
    {!! Form::close() !!}
@stop