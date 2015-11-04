<tr>
    @can('filter-managers')
    <td colspan="7" class="uk-text-center">
        На данный момент событий нет.
        {!! link_to_route('crm.customer-event.create', 'Создать событие') !!}.
    </td>
    @else
        <td colspan="6" class="uk-text-center">
            На данный момент событий нет.
            {!! link_to_route('crm.customer-event.create', 'Создать событие') !!}.
        </td>
    @endcan
</tr>