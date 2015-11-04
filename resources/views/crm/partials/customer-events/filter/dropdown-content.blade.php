<li>
    <a href="#" class="js-checkbox js-checkbox-all">
        <i class="events-table__dropdown-item-icon uk-icon-check-square js-checkbox-icon"></i>
        @set($select_all_title = (isset($select_all_title) ? $select_all_title : 'Выбрать все'))
        {{ $select_all_title }}
    </a>
</li>
<li class="uk-nav-divider"></li>
@foreach($items as $item)
    <li>
        <a href="#" class="js-checkbox" data-id="{{ $item->id }}">
            <i class="events-table__dropdown-item-icon uk-icon-check-square js-checkbox-icon"></i>
            {{ $item->name }}
        </a>
    </li>
@endforeach