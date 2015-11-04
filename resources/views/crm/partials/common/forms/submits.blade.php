@if ( ! isset($wrap) || $wrap === true)
<div class="uk-form-row">
    @include('crm.partials.common.forms.submit')
    @include('crm.partials.common.forms.delete')
</div>
@else
    @include('crm.partials.common.forms.submit')
    @include('crm.partials.common.forms.delete')
@endif