@extends('crm.layouts.master')
@section('page-title', 'Редактирование события')
@section('content-title', 'Редактирование события')
@section('content')
    @include('crm.partials.customer-events.form', [
        'event' => $event,
        'action' => 'update'
    ])
@stop