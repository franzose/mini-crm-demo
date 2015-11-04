@set($dropdown_classes = [
    'uk-dropdown',
    'uk-dropdown-bottom'
])

@if (isset($dropdown_class))
    @set($dropdown_classes[] = $dropdown_class)
@endif

<div class="events-table__dropdown uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
    <button class="uk-button">{{ $title }} <i class="uk-icon-caret-down"></i></button>
    <div class="{{ implode(' ', $dropdown_classes) }}"> <!--  uk-dropdown-scrollable -->
        <ul @if (isset($list_id)) id="{{ $list_id }}" @endif
            class="events-table__dropdown-list uk-form uk-nav uk-nav-dropdown js-checkboxes">
            @set($content = (isset($content) ? $content : 'crm.partials.customer-events.filter.dropdown-content'))
            @include($content)
        </ul>
    </div>
</div>