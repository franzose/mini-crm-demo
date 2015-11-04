@extends('crm.layouts.master')
@section('page-title', 'Редактирование заказчика')
@section('content-title', 'Редактирование заказчика')
@section('content')
    @include('crm.partials.customers.form', [
        'customer' => $customer,
        'action' => 'update'
    ])
@stop