@foreach($items as $item)
    @set($hasChildren = $item->hasChildren())
    <li @lm-attrs($item) @if($hasChildren) class="uk-parent" data-uk-dropdown="{mode:'click'}" @endif @lm-endattrs>
        @if ($item->link)
            <a @lm-attrs($item->link) @lm-endattrs href="{!! $item->url() !!}">
                {!! $item->title !!}
                @if ($hasChildren)
                <i class="uk-icon-caret-down"></i>
                @endif
            </a>
        @else
            {{ $item->title }}
        @endif
        @if ($hasChildren)
        <div class="uk-dropdown-navbar uk-dropdown uk-dropdown-bottom">
            <ul class="uk-nav uk-nav-dropdown">
                @include('crm.partials.layouts.master.navbar-items', ['items' => $item->children()])
            </ul>
        </div>
        @endif
    </li>
    @if($item->divider)
    <li {!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
    @endif
@endforeach