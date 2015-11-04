@include('crm.partials.common.forms.errors')
@include('crm.partials.common.forms.success')

@include('crm.partials.common.forms.open', [
    'model' => $user,
    'id' => 'crm-user-form'
])

<div class="uk-form-row">
    {!! Form::label('name', 'ФИО', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::text('name', Input::old('name'), ['required' => true]) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('login', 'Логин', ['class' => 'uk-form-label uk-form-label-required']) !!}
    <div class="uk-form-controls">
        {!! Form::text('login', Input::old('login'), ['required' => true]) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('email', 'E-mail', ['class' => 'uk-form-label']) !!}
    <div class="uk-form-controls">
        {!! Form::email('email', Input::old('email')) !!}
    </div>
</div>
<div class="uk-form-row">
    {!! Form::label('phone', 'Телефон', ['class' => 'uk-form-label']) !!}
    <div class="uk-form-controls">
        {!! Form::text('phone', Input::old('phone')) !!}
    </div>
</div>
<hr>
@include('crm.partials.common.forms.password', compact('action'))
<hr>
<div class="uk-form-row">
    <span class="uk-form-label">Роли</span>
    <div class="uk-form-controls uk-form-controls-text">
        @foreach($roles as $role)
            @set($role_id = 'role-' . $role->id)
            <label class="uk-margin-right">
                {!! Form::checkbox('roles[]', $role->id, ($user && $user->is($role->name)), ['id' => $role_id]) !!}
                {{ $role->title }}
            </label>
        @endforeach
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