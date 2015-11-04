@extends('crm.layouts.master')
@section('page-title', 'События')
@section('content-title', 'События')
@section('content')
    @if ($events->count())
    <div class="uk-form uk-grid">
        <div class="uk-width-1-4">
            <label class="uk-form-label" for="crm-filter-categories">Категории</label>
            <div class="uk-form-controls">
                {!! Form::select('', $categories, null, [
                    'id' => 'crm-filter-categories',
                    'class' => 'uk-width-1-1'
                ]) !!}
            </div>
        </div>
        <div class="uk-width-1-4">
            <label class="uk-form-label" for="crm-filter-customers">Заказчик</label>
            <div class="uk-form-controls">
                {!! Form::select('', $customers, null, [
                    'id' => 'crm-filter-customers',
                    'class' => 'uk-width-1-1'
                ]) !!}
            </div>
        </div>
        @can('filter-managers')
        <div class="uk-width-1-4">
            <label class="uk-form-label" for="crm-filter-managers">Менеджер</label>
            <div class="uk-form-controls">
                {!! Form::select('', $managers, null, [
                    'id' => 'crm-filter-managers',
                    'class' => 'uk-width-1-1'
                ]) !!}
            </div>
        </div>
        @endcan
        <div class="uk-width-1-4">
            <label class="uk-form-label" for="crm-filter-statuses">Статус переговоров</label>
            <div class="uk-form-controls">
                {!! Form::select('', $statuses, null, [
                    'id' => 'crm-filter-statuses',
                    'class' => 'uk-width-1-1'
                ]) !!}
            </div>
        </div>
    </div>
    @endif

    <table class="uk-table uk-table-hover uk-table-striped">
        <thead>
        <tr>
            <th>Событие</th>
            @can('filter-managers')
            <th>Менеджер</th>
            @endcan
            <th>Заказчик</th>
            <th>Категория</th>
            <th>Статус переговоров</th>
        </tr>
        </thead>
        <tbody>
        @forelse($events as $event)
            @set($customer = $event->customer)
            @set($manager = $customer->manager)
            @set($status = $customer->status)
            @set($category = $customer->category)
            <tr>
                <td>
                    <span class="uk-badge uk-badge-warning">{{ $event->date }}</span>
                    {{ $event->description }}
                </td>
                @can('filter-managers')
                <td>
                    @can('edit-entities')
                    {!! link_to_route('crm.user.edit', $manager->name, ['id' => $manager->getKey()]) !!}
                    @else
                    {{ $manager->name }}
                    @endcan
                </td>
                @endcan
                <td>
                    @can('edit-entities')
                    {!! link_to_route('crm.customer.edit', $manager->name, ['id' => $customer->getKey()]) !!}
                    @else
                    {{ $customer->name }}
                    @endcan
                </td>
                <td>{{ $category->name }}</td>
                <td>{{ $status->name }}</td>
            </tr>
        @empty
            <tr>
            @can('filter-managers')
                <td colspan="5" class="uk-text-center">
                    На данный момент событий нет.
                    {!! link_to_route('crm.customer-event.create', 'Создать событие') !!}.
                </td>
            @else
                <td colspan="4" class="uk-text-center">
                    На данный момент событий нет.
                    {!! link_to_route('crm.customer-event.create', 'Создать событие') !!}.
                </td>
            @endcan
            </tr>
        @endforelse
        <tr>
            <td>
                <span class="uk-badge">29.12.2015</span>
                Позвонил, сказали «Вау!» и тут же согласились.
            </td>
            @can('filter-managers')
            <td>{!! link_to_route('crm.user.edit', 'А.А. Тушинский', ['id' => 1]) !!}</td>
            @endcan
            <td>{!! link_to_route('crm.customer.edit', 'ООО Агропромстрой', ['id' => 1]) !!}</td>
            <td>Строительные материалы</td>
            <td><span class="uk-badge uk-badge-success">Согласен</span></td>
        </tr>
        </tbody>
    </table>
@stop