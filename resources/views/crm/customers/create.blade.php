@extends('crm.layouts.master')
@section('page-title', 'Новый заказчик')
@section('content-title', 'Новый заказчик')
@section('content')
    @include('crm.partials.customers.form', [
        'customer' => $customer,
        'action' => 'store'
    ])
@stop