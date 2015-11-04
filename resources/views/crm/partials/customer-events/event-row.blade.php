@set($customer = $event->customer)
@set($manager = $customer->manager)
@set($status = $customer->status)
@set($category = $customer->category)
<tr>
    <td>
        <a href="{{ route('crm.customer-event.edit', ['id' => $event->id]) }}">
            <i class="uk-icon-pencil"></i>
        </a>
    </td>
    <td>
        <span class="uk-badge">{{ $event->date }}</span><br>
        {{ $event->description }}
    </td>
    <td><span class="uk-badge uk-badge-neutral">{{ $event->type->name }}</span></td>
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
        {!! link_to_route('crm.customer.edit', $customer->name, ['id' => $customer->getKey()]) !!}
        @else
            {{ $customer->name }}
            @endcan
    </td>
    <td>@if ($category){{ $category->name }}@endif</td>
    <td><span class="uk-badge uk-badge-{{ $status->color }}">{{ $status->name }}</span></td>
</tr>