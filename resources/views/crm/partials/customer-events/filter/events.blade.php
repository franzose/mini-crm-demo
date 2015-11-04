<li>
    <div class="events-table__date uk-align-left">
        {!! Form::text('', '', [
            'id' => 'start-date',
            'class' => 'uk-width-1-1 js-date',
            'placeholder' => 'Начальная дата'
        ]) !!}
    </div>
    <div class="events-table__date uk-align-right">
        {!! Form::text('', '', [
            'id' => 'end-date',
            'class' => 'uk-width-1-1 js-date',
            'placeholder' => 'Конечная дата'
        ]) !!}
    </div>
</li>
<li>{!! Form::text('', '', [
    'id' => 'search',
    'class' => 'uk-width-1-1',
    'placeholder' => 'Поиск'
]) !!}</li>