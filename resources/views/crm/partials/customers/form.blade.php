@include('crm.partials.common.forms.errors')
@include('crm.partials.common.forms.success')

@include('crm.partials.common.forms.open', [
    'model' => $customer,
    'id' => 'crm-customer-form'
])
<div class="uk-form-row">
    {!! Form::label('category_id', 'Категория', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::select('category_id', $categories, Input::old('category_id'), ['class' => 'uk-width-1-3']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('manager_id', 'Менеджер', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::select('manager_id', $managers, Input::old('manager_id'), ['class' => 'uk-width-1-3']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('name', 'Название', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::text('name', Input::old('name'), ['required' => true, 'class' => 'uk-width-1-2']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('legal_name', 'Юридическое название', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::text('legal_name', Input::old('legal_name'), ['required' => true, 'class' => 'uk-width-1-2']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('address', 'Адрес', ['class' => 'uk-form-label']) !!}
    <div class="uk-form-controls">
        {!! Form::text('address', Input::old('address'), ['class' => 'uk-width-1-2']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('contact_person', 'Контактное лицо', ['class' => 'uk-form-label']) !!}
    <div class="uk-form-controls">
        {!! Form::text('contact_person', Input::old('contact_person'), ['class' => 'uk-width-1-2']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('person_position', 'Должность', ['class' => 'uk-form-label']) !!}
    <div class="uk-form-controls">
        {!! Form::text('person_position', Input::old('person_position'), ['class' => 'uk-width-1-2']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('phone', 'Телефоны', ['class' => 'uk-form-label']) !!}
    <div class="uk-form-controls">
        {!! Form::text('phone', Input::old('phone'), ['class' => 'uk-width-1-2']) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('status_id', 'Статус', ['class' => 'uk-form-label']) !!}
    <div class="uk-form-controls">
        {!! Form::select('status_id', $statuses, Input::old('status_id'), ['class' => 'uk-width-1-3']) !!}
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