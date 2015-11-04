@extends('crm.layouts.master')
@section('page-title', 'Все заказчики')
@section('content-title', 'Все заказчики')
@section('content-title-addon')
    <a href="{{ route('crm.customer.create') }}"
       class="uk-button uk-button-primary uk-button-mini">
        <i class="uk-icon-plus-square"></i>
        Добавить нового
    </a>
@stop
@section('content')
    @include('crm.partials.common.lists.success-alert')
    <table class="uk-table uk-table-hover uk-table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th>Юридическое название</th>
            <th>Контакты</th>
            <th>Телефоны</th>
            <th>Категория</th>
            <th>Менеджер</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        @forelse($customers as $customer)
            @set($category = $customer->category)
            @set($manager = $customer->manager)
            @set($status = $customer->status)
            <tr>
                <td>
                    @can('edit-entities')
                    {!! link_to_route('crm.customer.edit', $customer->name, ['id' => $customer->id]) !!}
                    @else
                    {{ $customer->name }}
                    @endcan
                </td>
                <td>
                    @can('edit-entities')
                    {!! link_to_route('crm.customer.edit', $customer->legal_name, ['id' => $customer->id]) !!}
                    @else
                    {{ $customer->legal_name }}
                    @endif
                </td>
                <td>
                    {{ $customer->contact_person }}<br>
                    {{ $customer->person_position }}
                </td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    @can('edit-users')
                    {!! link_to_route('crm.user.edit', $manager->name, ['id' => $manager->id]) !!}
                    @else
                    {{ $manager->name }}
                    @endcan
                </td>
                <td>
                    <span class="uk-badge uk-badge-{{ $status->color }}">{{ $status->name }}</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="uk-text-center">
                    Ни одного заказчика пока нет.
                    @can('edit-entities')
                    {!! link_to_route('crm.customer.create', 'Добавить нового') !!}.
                    @endcan
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {!! $pagination !!}
@stop