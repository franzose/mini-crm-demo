@extends('crm.layouts.master')
@section('page-title', 'Категории предприятий')
@section('content-title', 'Категории предприятий')
@section('content')
    <div id="crm-customer-categories" class="uk-grid">
        <div id="crm-customer-categories-list" class="uk-width-1-2">
            @foreach($categories as $idx => $category)
                @include('crm.partials.common.forms.open', [
                    'model' => $category,
                    'action' => 'update',
                    'class' => 'js-customer-category-form'
                ])
                {!! Form::text('name', $category->name, ['id' => 'name-' . $idx]) !!}
                @include('crm.partials.common.forms.submits', [
                    'resource' => 'customer-category',
                    'id' => $category->id,
                    'wrap' => false,
                    'is_ajax' => true,
                    'ajax_destroy' => true
                ])
                {!! Form::close() !!}
            @endforeach
        </div>
        <div class="uk-width-1-2">
            <h2>Новая категория</h2>
            @include('crm.partials.common.forms.open', [
                'model' => null,
                'action' => 'store',
                'id' => 'crm-customer-category-quick-form',
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