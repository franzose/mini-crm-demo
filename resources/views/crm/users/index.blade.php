@extends('crm.layouts.master')
@section('page-title', 'Все сотрудники')
@section('content-title', 'Все сотрудники')
@section('content-title-addon')
    <a href="{{ route('crm.user.create') }}"
       class="uk-button uk-button-primary uk-button-mini">
        <i class="uk-icon-plus-square"></i>
        Добавить нового
    </a>
@stop
@section('content')
    @include('crm.partials.common.lists.success-alert')
    <div class="users-list uk-grid">
        @forelse($users as $user)
            @set($is_new_user = (session()->get('new_user_id') == $user->id))
            <div class="users-list__user uk-width-1-4">
                <div class="uk-panel uk-panel-hover @if ($is_new_user) uk-panel-box uk-panel-box-primary @endif">
                    <div class="uk-panel-header">
                        <h3 class="users-list__name uk-panel-title">
                            {!! link_to_route('crm.user.edit', $user->name, ['id' => $user->id]) !!}
                        </h3>
                    </div>
                    <dl class="users-list__data">
                        <dt class="users-list__data-key"><i class="uk-icon-user"></i> Логин</dt>
                        <dd class="users-list__data-value">{{ $user->login }}</dd>
                        <dt class="users-list__data-key"><i class="uk-icon-envelope"></i> E-mail</dt>
                        <dd class="users-list__data-value">
                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                        </dd>
                        <dt class="users-list__data-key">Роли</dt>
                        <dd class="users-list__data-value">
                            @foreach($user->roles as $role)
                                {{ $role->title }}<br>
                            @endforeach
                        </dd>
                    </dl>
                </div>
            </div>
        @empty
        <p>Вы не добавили ни одного сотрудника.</p>
        @endforelse
    </div>
    {!! $pagination !!}
@stop