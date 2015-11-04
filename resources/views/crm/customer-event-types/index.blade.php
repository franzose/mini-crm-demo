@extends('crm.layouts.master')
@section('page-title', 'Типы событий')
@section('content-title', 'Типы событий')
@section('content')
    <div id="crm-ce-types" class="uk-grid">
        <div id="crm-ce-types-list" class="uk-width-1-2">
            @foreach($types as $idx => $type)
                @include('crm.partials.common.forms.open', [
                    'model' => $type,
                    'action' => 'update',
                    'class' => 'js-type-form'
                ])
                {!! Form::text('name', $type->name, ['id' => 'name-' . $idx]) !!}
                @include('crm.partials.common.forms.submits', [
                    'resource' => 'customer-event-type',
                    'id' => $type->id,
                    'wrap' => false,
                    'is_ajax' => true,
                    'ajax_destroy' => true
                ])
                {!! Form::close() !!}
            @endforeach
        </div>
        <div class="uk-width-1-2">
            <h2>Новый тип событий</h2>
            @include('crm.partials.common.forms.open', [
                'model' => null,
                'action' => 'store',
                'id' => 'crm-customer-status-quick-form',
                'horizontal' => false
            ])
            <div class="uk-form-row">
                {!! Form::label('name', 'Название', ['class' => 'uk-form-label uk-form-label-required']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('name', null, ['class' => 'uk-width-1-2']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                @include('crm.partials.common.forms.submit', ['creating' => true, 'is_ajax' => true])
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop