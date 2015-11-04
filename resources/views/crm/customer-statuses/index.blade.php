@extends('crm.layouts.master')
@section('page-title', 'Статусы переговоров')
@section('content-title', 'Статусы переговоров')
@section('content')
    <div id="crm-customer-statuses" class="uk-grid">
        <div id="crm-customer-statuses-list" class="uk-width-1-2">
            @foreach($statuses as $idx => $status)
                @include('crm.partials.common.forms.open', [
                    'model' => $status,
                    'action' => 'update',
                    'class' => 'js-status-form'
                ])
                {!! Form::text('name', $status->name, ['id' => 'name-' . $idx]) !!}
                @include('crm.partials.common.forms.submits', [
                    'resource' => 'customer-status',
                    'id' => $status->id,
                    'wrap' => false,
                    'is_ajax' => true,
                    'ajax_destroy' => true
                ])
                <br>
                @foreach($colors as $idx => $color)
                    <span class="uk-radio-badge uk-badge @if ($color) uk-badge-{{ $color }} @endif">
                        {!! Form::radio('color', $color) !!}
                    </span>
                @endforeach
                {!! Form::close() !!}
            @endforeach
        </div>
        <div class="uk-width-1-2">
            <h2>Новый статус</h2>
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
                <h3>Цвет</h3>
                <div class="uk-form-controls">
                    @foreach($colors as $color)
                        {!! Form::radio('color', $color, $color == 'neutral') !!}
                        <span class="uk-badge @if ($color) uk-badge-{{ $color }} @endif">ПРИМЕР</span>
                        <br>
                    @endforeach
                </div>
                <p>Статус будет отмечаться выбранным цветом.</p>
            </div>
            <div class="uk-form-row">
                @include('crm.partials.common.forms.submit', ['creating' => true, 'is_ajax' => true])
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop