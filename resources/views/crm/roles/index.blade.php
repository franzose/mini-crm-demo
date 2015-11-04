@extends('crm.layouts.master')
@section('page-title', 'Роли пользователей')
@section('content-title', 'Роли пользователей')
@section('content')
    <div id="crm-roles" class="uk-grid">
        <div id="crm-roles-list" class="uk-width-1-2">
            @foreach($roles as $idx => $role)
                @include('crm.partials.common.forms.open', [
                    'model' => $role,
                    'action' => 'update',
                    'class' => 'js-role-form'
                ])
                {!! Form::text('title', $role->title, ['id' => 'name-' . $idx]) !!}
                @include('crm.partials.common.forms.submits', [
                    'resource' => 'role',
                    'id' => $role->id,
                    'wrap' => false,
                    'is_ajax' => true,
                    'ajax_destroy' => true
                ])
                {!! Form::close() !!}
            @endforeach
        </div>
        <div class="uk-width-1-2">
            <h2>Новая роль</h2>
            @include('crm.partials.common.forms.open', [
                'model' => null,
                'action' => 'store',
                'id' => 'crm-role-quick-form',
                'horizontal' => false
            ])
            <div class="uk-form-row">
                {!! Form::label('name', 'Техническое название', ['class' => 'uk-form-label uk-form-label-required']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('name', null, [
                        'class' => 'uk-width-1-2',
                        'placeholder' => 'Например, admin'
                    ]) !!}
                    <div><small><em>После создания роли данное поле изменить будет невозможно.</em></small></div>
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('title', 'Название для отображения в CRM', ['class' => 'uk-form-label uk-form-label-required']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('title', null, [
                        'class' => 'uk-width-1-2',
                        'placeholder' => 'Например, Администратор'
                    ]) !!}
                </div>
            </div>
            <div class="uk-form-row">
                @include('crm.partials.common.forms.submit', ['creating' => true, 'is_ajax' => true])
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop