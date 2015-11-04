@extends('crm.layouts.master')
@section('page-title', 'Новое событие')
@section('content-title', 'Новое событие')
@section('content')
    @include('crm.partials.customer-events.form', [
        'event' => $event,
        'action' => 'store'
    ])
@stop