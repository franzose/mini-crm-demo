@if ($errors->count())
    <div class="uk-alert uk-alert-danger">
        <ul>
            @foreach($errors->all('<li>:message</li>') as $message)
                {!! $message !!}
            @endforeach
        </ul>
    </div>
@endif