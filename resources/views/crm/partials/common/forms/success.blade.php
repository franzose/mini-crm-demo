@if (session()->has('success'))
<div class="uk-alert uk-alert-success" data-uk-alert>
	<a href="#" class="uk-alert-close uk-close"></a>
	<p>{!! session()->get('success') !!}</p>
</div>
@endif