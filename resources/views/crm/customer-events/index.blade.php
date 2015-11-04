@extends('crm.layouts.master')
@section('page-title', 'События')
@section('content-title', 'События')
@section('content-title-addon')
    <a href="{{ route('crm.customer-event.create') }}"
       class="uk-button uk-button-primary uk-button-mini">
        <i class="uk-icon-plus-square"></i>
        Создать новое
    </a>
@stop
@section('content-class', 'customer-events')
@section('content')
    @include('crm.partials.common.forms.success')

    <div id="events-container" class="events-container">
        <table id="events-table" class="events-table uk-table uk-table-hover uk-table-striped">
            <thead>
            <tr>
                <th></th>
                <th class="events-table__description-column">
                    @include('crm.partials.customer-events.filter.dropdown', [
                        'title' => 'Событие',
                        'dropdown_class' => 'events-table__event-dropdown',
                        'content' => 'crm.partials.customer-events.filter.events'
                    ])
                </th>
                <th>
                    @include('crm.partials.customer-events.filter.dropdown', [
                        'title' => 'Тип',
                        'items' => $types,
                        'list_id' => 'types'
                    ])
                </th>
                @can('filter-managers')
                <th>
                    @include('crm.partials.customer-events.filter.dropdown', [
                        'title' => 'Менеджер',
                        'items' => $managers,
                        'list_id' => 'managers',
                        'select_all_title' => 'Выбрать всех'
                    ])
                </th>
                @endcan
                <th>
                    @include('crm.partials.customer-events.filter.dropdown', [
                        'title' => 'Заказчик',
                        'items' => $customers,
                        'list_id' => 'customers',
                        'select_all_title' => 'Выбрать всех'
                    ])
                </th>
                <th>
                    @include('crm.partials.customer-events.filter.dropdown', [
                        'title' => 'Категория',
                        'items' => $categories,
                        'list_id' => 'categories'
                    ])
                </th>
                <th>
                    @include('crm.partials.customer-events.filter.dropdown', [
                        'title' => 'Статус',
                        'items' => $statuses,
                        'list_id' => 'statuses'
                    ])
                </th>
            </tr>
            </thead>
            <tbody id="events-table-body">
            @forelse($events as $event)
                @include('crm.partials.customer-events.event-row', compact('event'))
            @empty
                @include('crm.partials.customer-events.empty-row')
            @endforelse
            </tbody>
        </table>
        <div id="pagination">{!! $pagination !!}</div>
    </div>
@stop