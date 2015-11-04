@if (session()->has('success'))
    <div class="uk-alert uk-alert-success">{{ session('success') }}</div>
@endif