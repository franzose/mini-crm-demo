@include('crm.partials.common.forms.errors')
@include('crm.partials.common.forms.success')

@include('crm.partials.common.forms.open', [
    'model' => $event,
    'id' => 'crm-customer-event-form'
])
<div class="uk-form-row">
    {!! Form::label('type_id', 'Тип события', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::select('type_id', $types, Input::old('type_id'), ['class' => 'uk-width-1-3']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('customer_id', 'Заказчик', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::select('customer_id', $customers, Input::old('customer_id'), ['class' => 'uk-width-1-3']) !!}
    </div>
</div>
@can('edit-users')
<div class="uk-form-row">
    {!! Form::label('manager_id', 'Менеджер', ['class' => 'uk-form-label']) !!}
    <div class="uk-form-controls">
        {!! Form::select('manager_id', $managers, Input::old('manager_id'), ['class' => 'uk-width-1-3']) !!}
    </div>
</div>
@endcan
<div class="uk-form-row">
    {!! Form::label('event_date', 'Дата', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls uk-position-relative">
        {!! Form::text('event_date', Input::old('event_date'), ['required' => true]) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('event_time', 'Время', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls uk-position-relative">
        {!! Form::text('event_time', Input::old('event_time'), ['required' => true]) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('description', 'Описание', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::textarea('description', Input::old('description'), ['required' => true]) !!}
    </div>
</div>
@if ($action == 'store')
    <div class="uk-form-row">
        @include('crm.partials.common.forms.submit')
    </div>
@else
    @include('crm.partials.common.forms.submits')
@endif
{!! Form::close() !!}